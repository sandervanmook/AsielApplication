<?php


namespace Asiel\AnimalBundle\Controller;


use Asiel\AnimalBundle\Form\TaskType;
use Asiel\AnimalBundle\Service\TaskFormHandler;
use Asiel\CalendarBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendTaskController extends Controller
{
    private $taskFormHandler;

    public function __construct(TaskFormHandler $taskFormHandler)
    {
        $this->taskFormHandler = $taskFormHandler;
    }

    /**
     * @param $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        return $this->render('@Animal/Backend/Task/index.html.twig', [
            'result'    => $this->taskFormHandler->findAnimal($id)->getTasks(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @param int $taskid
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, int $id, int $taskid)
    {
        $task = $this->taskFormHandler->find($taskid);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->taskFormHandler->edit();

            return new RedirectResponse($this->generateUrl('backend_animal_task_index', ['id' => $id]));
        }

        return $this->render(('@Animal/Backend/Task/edit.html.twig'), [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteAction(int $id)
    {
        $this->taskFormHandler->delete($this->taskFormHandler->find($id));

        return new Response('Command received.');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->taskFormHandler->createByForm($task, $id);

            return new RedirectResponse($this->generateUrl('backend_animal_task_index', ['id' => $id]));
        }

        return $this->render(('@Animal/Backend/Task/create.html.twig'), [
            'form'      => $form->createView(),
        ]);
    }
}