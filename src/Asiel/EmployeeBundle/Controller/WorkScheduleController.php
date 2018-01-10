<?php


namespace Asiel\EmployeeBundle\Controller;


use Asiel\EmployeeBundle\Entity\WorkSchedule;
use Asiel\EmployeeBundle\Form\WorkScheduleType;
use Asiel\EmployeeBundle\Service\WorkScheduleFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkScheduleController extends Controller
{
    private $workscheduleFormHandler;

    public function __construct(WorkScheduleFormHandler $workScheduleFormHandler)
    {
        $this->workscheduleFormHandler = $workScheduleFormHandler;
    }

    /**
     * @param integer $id
     * @return Response
     */
    public function indexAction(int $id)
    {

        return $this->render('@Employee/Backend/WorkSchedule/index.html.twig', [
            'schedule' => $this->workscheduleFormHandler->getRepository()->findOneBy(['user' => $id]),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, int $id)
    {
        $query = $this->workscheduleFormHandler->getRepository()->findOneBy(['user' => $id]);

        if (!$query) {
            $schedule = new WorkSchedule();
        } else {
            $schedule = $query;
        }

        $form = $this->createForm(WorkScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (is_null($schedule->getId())) {
                $this->workscheduleFormHandler->createSchedule($schedule, $id);
            } else {
                $this->workscheduleFormHandler->edit();
            }

            return new RedirectResponse($this->generateUrl('backend_employee_workschedule_index', ['id' => $id]));
        }

        return $this->render('@Employee/Backend/WorkSchedule/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}