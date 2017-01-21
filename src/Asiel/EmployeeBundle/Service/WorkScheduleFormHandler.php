<?php


namespace Asiel\EmployeeBundle\Service;


use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\EmployeeBundle\Entity\WorkSchedule;
use Asiel\EmployeeBundle\Repository\WorkScheduleRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class WorkScheduleFormHandler
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

    public function getRepository(): WorkScheduleRepository
    {
        return $this->em->getRepository('EmployeeBundle:WorkSchedule');
    }

    public function createSchedule(WorkSchedule $schedule, int $userid)
    {
        $user = $this->em->getRepository('EmployeeBundle:User')->find($userid);
        $schedule->setUser($user);
        $this->em->persist($schedule);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Werkschema is aangemaakt.'));
    }

    public function edit()
    {
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

}