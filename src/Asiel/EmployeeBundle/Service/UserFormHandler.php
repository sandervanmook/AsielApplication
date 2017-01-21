<?php


namespace Asiel\EmployeeBundle\Service;


use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\EmployeeBundle\Entity\User;
use Asiel\EmployeeBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class UserFormHandler
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
     * @param User $user
     */
    public function create(User $user)
    {
        // User should always get ROLE_USER
        $roles = $user->getRoles();
        array_push($roles, 'ROLE_USER');
        $user->setRoles($roles);

        $this->em->persist($user);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Gebruiker is aangemaakt.'));
    }

    /**
     * @param User $user
     */
    public function edit(User $user)
    {
        // User should always get ROLE_USER
        $roles = $user->getRoles();
        if (!in_array('ROLE_USER', $roles)) {
            array_push($roles, 'ROLE_USER');
            $user->setRoles($roles);
        }

        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    /**
     * @param int $userId
     * @return null|User
     */
    public function find(int $userId)
    {
        $user = $this->getRepository()->find($userId);

        if (!$user) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Gebruiker', $userId));
        }

        return $user;
    }

    public function getRepository(): UserRepository
    {
        return $this->em->getRepository('EmployeeBundle:User');
    }

}