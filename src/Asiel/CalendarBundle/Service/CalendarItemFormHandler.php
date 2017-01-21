<?php


namespace Asiel\CalendarBundle\Service;


use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\CalendarItem;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CalendarItemFormHandler
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
     * @param CalendarItem $calendarItem
     */
    public function create(CalendarItem $calendarItem)
    {
        $this->em->persist($calendarItem);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Item is aangemaakt.'));
    }

    /**
     * @param int $id
     * @return CalendarItem|null
     */
    public function find(int $id)
    {
        $calendarItem = $this->em->getRepository('CalendarBundle:CalendarItem')->find($id);

        if (!$calendarItem) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Agendapunt', $id));
        }

        return $calendarItem;
    }

    public function edit()
    {
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }
}