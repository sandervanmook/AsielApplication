<?php


namespace Asiel\CalendarBundle\Controller;


use Asiel\CalendarBundle\Entity\CalendarItem;
use Asiel\CalendarBundle\Form\CalendarItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendCalendarItemController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $formHandler = $this->get('asiel.calendarbundle.calendaritemformhandler');
        $calendarItem = new CalendarItem();

        $form = $this->createForm(CalendarItemType::class, $calendarItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->create($calendarItem);

            return new RedirectResponse($this->generateUrl('backend_calendar'));
        }

        return $this->render('@Calendar/Backend/CalendarItem/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param int $itemid
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, int $itemid)
    {
        $formHandler = $this->get('asiel.calendarbundle.calendaritemformhandler');
        $calendarItem = $formHandler->find($itemid);

        $form = $this->createForm(CalendarItemType::class, $calendarItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->edit();

            return new RedirectResponse($this->generateUrl('backend_calendar'));
        }

        return $this->render('@Calendar/Backend/CalendarItem/edit.html.twig', [
            'form'      => $form->createView(),
        ]);
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

        $result = $this->getDoctrine()->getRepository('CalendarBundle:CalendarItem')->calendarData($end, $fixedStart);

        return new JsonResponse($result);

    }

}