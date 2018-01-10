<?php


namespace Asiel\CalendarBundle\Controller;


use Asiel\CalendarBundle\Entity\CalendarItem;
use Asiel\CalendarBundle\Form\CalendarItemType;
use Asiel\CalendarBundle\Service\CalendarItemFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendCalendarItemController extends Controller
{
    private $calenderItemFormHandler;

    public function __construct(CalendarItemFormHandler $calendarItemFormHandler)
    {
        $this->calenderItemFormHandler = $calendarItemFormHandler;
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $calendarItem = new CalendarItem();

        $form = $this->createForm(CalendarItemType::class, $calendarItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->calenderItemFormHandler->create($calendarItem);

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
        $calendarItem = $this->calenderItemFormHandler->find($itemid);

        $form = $this->createForm(CalendarItemType::class, $calendarItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->calenderItemFormHandler->edit();

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