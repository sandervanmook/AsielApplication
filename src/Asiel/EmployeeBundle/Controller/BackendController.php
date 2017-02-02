<?php


namespace Asiel\EmployeeBundle\Controller;


use Asiel\EmployeeBundle\Entity\User;
use Asiel\EmployeeBundle\Form\EditPasswordType;
use Asiel\EmployeeBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $formHandler = $this->get('asiel.employeebundle.userformhandler');

        return $this->render('@Employee/Backend/index.html.twig', [
            'users' => $formHandler->getRepository()->findAll(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $formHandler = $this->get('asiel.employeebundle.userformhandler');
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->create($user);

            return new RedirectResponse($this->generateUrl('backend_employee_index'));
        }
        return $this->render('@Employee/Backend/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function showAction(int $id)
    {
        $formHandler = $this->get('asiel.employeebundle.userformhandler');

        return $this->render('@Employee/Backend/show.html.twig', [
            'user' => $formHandler->find($id),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.employeebundle.userformhandler');
        $user = $formHandler->find($id);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->edit($user);

            return new RedirectResponse($this->generateUrl('backend_employee_show', ['id' => $id]));
        }

        return $this->render('@Employee/Backend/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editPasswordAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.employeebundle.userformhandler');
        $user = $formHandler->find($id);

        $form = $this->createForm(EditPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->edit($user);

            return new RedirectResponse($this->generateUrl('backend_employee_show', ['id' => $id]));
        }

        return $this->render('@Employee/Backend/editPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Embedded as controller in template when editing a user.
     * @param integer $id
     * @return Response
     */
    public function userInfoAction(int $id)
    {
        $repository = $this->getDoctrine()->getRepository('EmployeeBundle:User');

        return $this->render('@Employee/Backend/userInfo.html.twig', [
            'user' => $repository->find($id),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function profileAction(Request $request, int $id)
    {
        // TODO replace this by voter
        if ($this->getUser()->getId() != $id) {
            return new RedirectResponse($this->generateUrl('backend_default_index'));
        }

        $repository = $this->getDoctrine()->getRepository('EmployeeBundle:User');
        $user = $repository->find($id);
        $formHandler = $this->get('asiel.employeebundle.userformhandler');

        $form = $this->createForm(EditPasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $formHandler->profileEditPassword($user, $password);

            return new RedirectResponse($this->generateUrl('backend_employee_profile', ['id' => $id]));
        }

        return $this->render('@Employee/Backend/profile.html.twig', [
            'user' => $user,
            'form'  => $form->createView(),
        ]);
    }
}