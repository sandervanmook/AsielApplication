<?php


namespace Asiel\AnimalBundle\Controller;


use Asiel\AnimalBundle\Form\TaskType;
use Asiel\CalendarBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendTaskController extends Controller
{
    /**
     * @param $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.taskformhandler');

        return $this->render('@Animal/Backend/Task/index.html.twig', [
            'result'    => $formHandler->findAnimal($id)->getTasks(),
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
        $formHandler = $this->get('asiel.animalbundle.taskformhandler');
        $task = $formHandler->find($taskid);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->edit();

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
        $formHandler = $this->get('asiel.animalbundle.taskformhandler');
        $formHandler->delete($formHandler->find($id));

        return new Response('Command received.');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.taskformhandler');
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->createByForm($task, $id);

            return new RedirectResponse($this->generateUrl('backend_animal_task_index', ['id' => $id]));
        }

        return $this->render(('@Animal/Backend/Task/create.html.twig'), [
            'form'      => $form->createView(),
        ]);
    }
}