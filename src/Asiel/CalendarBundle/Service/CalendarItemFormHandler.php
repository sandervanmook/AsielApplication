<?php


namespace Asiel\CalendarBundle\Service;


use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\CalendarItem;
use Asiel\Shared\Service\BaseFormHandler;

class CalendarItemFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function create(CalendarItem $calendarItem)
    {
        $this->baseFormHandler->getEm()->persist($calendarItem);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Item is aangemaakt.'));
    }

    public function find(int $calendarItemId): CalendarItem
    {
        return $this->baseFormHandler->findCalendarItem($calendarItemId);
    }

    public function edit()
    {
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }
}