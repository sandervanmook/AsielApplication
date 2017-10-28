<?php


namespace Asiel\CalendarBundle\Service;


use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\CalendarItem;
use Asiel\Shared\Service\BaseFormHandlerTrait;

class CalendarItemFormHandler
{
    use BaseFormHandlerTrait;

    public function create(CalendarItem $calendarItem)
    {
        $this->getEm()->persist($calendarItem);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Item is aangemaakt.'));
    }

    public function find(int $calendarItemId): CalendarItem
    {
        return $this->findCalendarItem($calendarItemId);
    }

    public function edit()
    {
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }
}