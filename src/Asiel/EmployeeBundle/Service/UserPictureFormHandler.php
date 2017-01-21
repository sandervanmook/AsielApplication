<?php


namespace Asiel\EmployeeBundle\Service;


use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\EmployeeBundle\Entity\UserPicture;
use Asiel\EmployeeBundle\Repository\UserPictureRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class UserPictureFormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
    }

    /**
     * @param int $id
     * @return null|UserPicture
     */
    public function find(int $id)
    {
        $userPicture = $this->getRepository()->find($id);

        if (!$userPicture) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Gebruikersfoto', $id));
        }

        return $userPicture;
    }

    public function create(UserPicture $userPicture)
    {
        // Is there a picture already ? Delete it
        $currentPicture = $this->getRepository()->findOneBy(['user' => $this->getRequestId()]);
        if ($currentPicture) {
            $this->delete($currentPicture);
        }

        $userRepository = $this->getEm()->getRepository('EmployeeBundle:User');
        $user = $userRepository->find($this->getRequestId());
        $userPicture->setUser($user);
        $this->getEm()->persist($userPicture);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'De foto is toegevoegd aan de medewerker.'));
    }

    public function delete(UserPicture $userPicture)
    {
        $this->em->remove($userPicture);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'De foto is verwijderd.'));
    }

    public function getRepository() : UserPictureRepository
    {
        return $this->em->getRepository('EmployeeBundle:UserPicture');
    }

    /**
     * @return int
     */
    public function getRequestId()
    {
        return (int)$this->requestStack->getCurrentRequest()->get('id');
    }

    public function getEm()
    {
        return $this->em;
    }

    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

}