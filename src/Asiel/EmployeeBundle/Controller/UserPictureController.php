<?php


namespace Asiel\EmployeeBundle\Controller;


use Asiel\EmployeeBundle\Entity\UserPicture;
use Asiel\EmployeeBundle\Form\UserPictureType;
use Asiel\EmployeeBundle\Service\UserPictureFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserPictureController extends Controller
{
    private $userPictureFormHandler;

    public function __construct(UserPictureFormHandler $userPictureFormHandler)
    {
        $this->userPictureFormHandler = $userPictureFormHandler;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        return $this->render('@Employee/Backend/UserPicture/index.html.twig', [
            'picture' => $this->userPictureFormHandler->getRepository()->findOneBy(['user' => $id]),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $userPicture = new UserPicture();

        $form = $this->createForm(UserPictureType::class, $userPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userPictureFormHandler->create($userPicture);

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
        $this->userPictureFormHandler->delete($this->userPictureFormHandler->find($id));

        return new Response('Command received.');
    }

}