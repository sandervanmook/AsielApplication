<?php


namespace Asiel\EmployeeBundle\Service;

use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\EmployeeBundle\Entity\User;
use Asiel\EmployeeBundle\Repository\UserRepository;
use Asiel\Shared\Service\BaseFormHandler;

class UserFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function create(User $user)
    {
        // User should always get ROLE_USER
        $roles = $user->getRoles();
        array_push($roles, 'ROLE_USER');
        $user->setRoles($roles);

        $this->baseFormHandler->getEm()->persist($user);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Gebruiker is aangemaakt.'));
    }

    public function edit(User $user)
    {
        // User should always get ROLE_USER
        $roles = $user->getRoles();
        if (!in_array('ROLE_USER', $roles)) {
            array_push($roles, 'ROLE_USER');
            $user->setRoles($roles);
        }

        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function find(int $userId): User
    {
        return $this->baseFormHandler->findUser($userId);
    }

    public function getRepository(): UserRepository
    {
        return $this->baseFormHandler->getUserRepository();
    }

    public function profileEditPassword(User $user, string $password)
    {
        $user->setPassword($password);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Uw wachtwoord is gewijzigd.'));
    }

}