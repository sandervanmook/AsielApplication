<?php


namespace Asiel\EmployeeBundle\Service;


use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\EmployeeBundle\Entity\UserPicture;
use Asiel\EmployeeBundle\Repository\UserPictureRepository;
use Asiel\Shared\Service\BaseFormHandler;


class UserPictureFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function find(int $userPictureId): UserPicture
    {
        return $this->baseFormHandler->findUserPicture($userPictureId);
    }

    public function create(UserPicture $userPicture)
    {
        $user = $this->baseFormHandler->findCustomer($this->baseFormHandler->getRequestId());
        $userPicture->setUser($user);
        $this->baseFormHandler->getEm()->persist($userPicture);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De foto is toegevoegd aan de medewerker.'));
    }

    public function delete(UserPicture $userPicture)
    {
        $this->baseFormHandler->getEm()->remove($userPicture);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De foto is verwijderd.'));
    }

    public function getRepository(): UserPictureRepository
    {
        return $this->baseFormHandler->getUserPictureRepository();
    }

}