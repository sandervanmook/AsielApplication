<?php


namespace Asiel\EmployeeBundle\Controller;


use Asiel\EmployeeBundle\Entity\UserPicture;
use Asiel\EmployeeBundle\Form\UserPictureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserPictureController extends Controller
{
    /**
     * @param int $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        $formHandler = $this->get('asiel.employeebundle.userpictureformhandler');

        return $this->render('@Employee/Backend/UserPicture/index.html.twig', [
            'picture' => $formHandler->getRepository()->findOneBy(['user' => $id]),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.employeebundle.userpictureformhandler');
        $userPicture = new UserPicture();

        $form = $this->createForm(UserPictureType::class, $userPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->create($userPicture);

            return new RedirectResponse($this->generateUrl('backend_employee_user_picture_index', ['id' => $id]));
        }
        return $this->render('@Employee/Backend/UserPicture/create.html.twig', [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteAction(int $id)
    {
        $formHandler = $this->get('asiel.employeebundle.userpictureformhandler');
        $formHandler->delete($formHandler->find($id));

        return new Response('Command received.');
    }

}