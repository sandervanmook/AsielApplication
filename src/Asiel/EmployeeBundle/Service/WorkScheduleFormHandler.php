<?php


namespace Asiel\EmployeeBundle\Service;


use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\EmployeeBundle\Entity\WorkSchedule;
use Asiel\EmployeeBundle\Repository\WorkScheduleRepository;
use Asiel\Shared\Service\BaseFormHandler;

class WorkScheduleFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function getRepository(): WorkScheduleRepository
    {
        return $this->baseFormHandler->getWorkScheduleRepository();
    }

    public function createSchedule(WorkSchedule $schedule, int $userId)
    {
        $user = $this->baseFormHandler->findUser($userId);
        $schedule->setUser($user);
        $this->baseFormHandler->getEm()->persist($schedule);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Werkschema is aangemaakt.'));
    }

    public function edit()
    {
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

}