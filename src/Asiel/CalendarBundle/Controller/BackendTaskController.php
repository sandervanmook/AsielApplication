<?php


namespace Asiel\CalendarBundle\Controller;


class BackendTaskController
{

    /**
     * Display the Calendar
     * @return Response
     */
    public function calendarAction()
    {
        return $this->baseController->getTwigEngine()->renderResponse('@Asiel/Animal/Task/calendar.html.twig');
    }

    /**
     * Json feed for Calendar
     * @return JsonResponse
     */
    public function calendarDataAction()
    {
        $end = $this->baseController->getRequestStack()->getCurrentRequest()->get('end');
        $start = $this->baseController->getRequestStack()->getCurrentRequest()->get('start');
        $fixedStart = $this->taskManager->fixCalendarStart($start);

        $result = $this->taskManager->getRepository()->calendarData($end, $fixedStart);

        return new JsonResponse($result);
    }

}