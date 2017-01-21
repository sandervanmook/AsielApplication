<?php

namespace Asiel\CustomerBundle\Controller;

use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Form\CustomerType;
use Asiel\CustomerBundle\Form\SearchCustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendCustomerController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');

        $searchForm = $this->createForm(SearchCustomerType::class);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $result = $formHandler->getRepository()->findCustomers($formHandler->getSearchArray($searchForm));

            return $this->render('@Customer/Backend/index.html.twig', [
                'allcustomers'  => $result,
                'searchform'    => $searchForm->createView(),
            ]);
        }

        return $this->render('@Customer/Backend/index.html.twig', [
            'allcustomers' => $formHandler->getRepository()->findAll(),
            'searchform'   => $searchForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');

        $form = $this->createForm(CustomerType::class, $formHandler->find($id));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->edit();

            return new RedirectResponse($this->generateUrl('backend_customer_index'));
        }
        return $this->render('@Customer/Backend/edit.html.twig', [
            'form'       => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');
        $customer = new Customer();

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->create($customer);

            return new RedirectResponse($this->generateUrl('backend_customer_index'));
        }

        return $this->render('@Customer/Backend/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Ajax Calls
     */

    /**
     * @param string $searchon
     * @return Response
     */
    public function searchOnLastNameAction($searchon = 'lastname')
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');

        $query['query']     = $formHandler->getRequestStack()->getCurrentRequest()->get('lastname');
        $query['searchon']  = $searchon;

        return $this->render('@Customer/Backend/customerSearch.html.twig', [
            'results' => $formHandler->getRepository()->findCustomers($query, 10),
        ]);
    }
}
