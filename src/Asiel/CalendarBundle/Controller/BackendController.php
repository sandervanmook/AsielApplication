<?php

namespace Asiel\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends Controller
{
    /**
     * Display the Calendar
     * @return Response
     */
    public function calendarAction()
    {
        return $this->render('@Calendar/Backend/calendar.html.twig');
    }

    /**
     * Json feed for Calendar
     * @param Request $request
     * @return JsonResponse
     */
    public function calendarDataAction(Request $request)
    {
        $end = $request->get('end');
        $start = $request->get('start');

        // Bug in fullCalendar ?
        $fixedStart = str_replace('"', '', $start);

        $result = $this->getDoctrine()->getRepository('CalendarBundle:Task')->calendarData($end, $fixedStart);

        return new JsonResponse($result);
    }
}
