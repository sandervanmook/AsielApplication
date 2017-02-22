<?php

namespace Asiel\CustomerBundle\Controller;

use Asiel\CustomerBundle\Entity\BusinessCustomer;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Entity\PrivateCustomer;
use Asiel\CustomerBundle\Form\BusinessCustomerType;
use Asiel\CustomerBundle\Form\CustomerType;
use Asiel\CustomerBundle\Form\PrivateCustomerType;
use Asiel\CustomerBundle\Form\SearchCustomerType;
use Asiel\CustomerBundle\SearchCustomer\FilterCustomer;
use Asiel\Shared\Filter\Customer\CustomerFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendCustomerController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $form = $this->createForm(SearchCustomerType::class);

        return $this->render('@Customer/Backend/index.html.twig', [
            'form'   => $form->createView(),
        ]);
    }

    /**
     * Ajax call
     * @param Request $request
     * @param string $requestby
     * @return Response
     */
    public function searchCustomersDataAction(Request $request, string $requestby)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');

        $allCustomers = $formHandler->getRepository()->findAll();

        $searchArray['lastname'] = $request->get('lastname');
        $searchArray['citizenservicenumber'] = $request->get('citizenservicenumber');
        $searchArray['municipality'] = $request->get('municipality');
        $searchArray['companyname'] = $request->get('companyname');

        $filterCustomer = new CustomerFilter($allCustomers, $searchArray);
        $filterCustomer->filter();

        $endResult = $filterCustomer->getFilterResult();

        switch ($requestby) {
            case 'statisticsbundle' :
                return $this->render('@Statistics/Backend/customerSearchResult.html.twig', [
                    'result' => $endResult,
                ]);
            case 'bookkeepingbundle_action' :
                return $this->render('@Bookkeeping/Backend/Action/searchCustomerResult.html.twig', [
                    'result' => $endResult,
                ]);
            case 'bookkeepingbundle_transaction' :
                return $this->render('@Bookkeeping/Backend/Transaction/searchCustomerResult.html.twig', [
                    'result' => $endResult,
                ]);
            case 'bookkeepingbundle_invoiceledger' :
                return $this->render('@Bookkeeping/Backend/InvoiceLedger/searchCustomerResult.html.twig', [
                    'result' => $endResult,
                ]);
            default:
                return $this->render('@Customer/Backend/searchResult.html.twig', [
                    'result' => $endResult,
                ]);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');

        $customer = $formHandler->findCustomer($id);
        $customerType = $customer->getClassName();

        $form = $this->createForm('Asiel\CustomerBundle\Form\\'.$customerType.'Type', $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->has('idcard')) {
                $idCard = $form->get('idcard')->getData();
            } else {
                $idCard = null;
            }

            $formHandler->edit($customer, $idCard);

            return new RedirectResponse($this->generateUrl('backend_customer_index'));
        }
        return $this->render('@Customer/Backend/edit.html.twig', [
            'form'       => $form->createView(),
        ]);
    }

    /**
     * @return Response
     */
    public function createAction()
    {
        return $this->render('@Customer/Backend/create.html.twig');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createPrivateAction(Request $request)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');
        $privateCustomer = new PrivateCustomer();

        $form = $this->createForm(PrivateCustomerType::class, $privateCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idCard = $form->get('idcard')->getData();
            $formHandler->createPrivate($privateCustomer, $idCard);

            return new RedirectResponse($this->generateUrl('backend_customer_index'));
        }

        return $this->render('@Customer/Backend/PrivateCustomer/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createBusinessAction(Request $request)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');
        $businessCustomer = new BusinessCustomer();

        $form = $this->createForm(BusinessCustomerType::class, $businessCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->createBusiness($businessCustomer);

            return new RedirectResponse($this->generateUrl('backend_customer_index'));
        }

        return $this->render('@Customer/Backend/BusinessCustomer/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param int $customerid
     * @return Response
     */
    public function showAction(int $customerid)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');

        $customer = $formHandler->findCustomer($customerid);

        if ($customer->isPrivate() && $customer->getIdCard()) {
            $photoData = $customer->getIdCard()->getPhoto();
            $photo = imagecreatefromstring(base64_decode($photoData));
            imagegif($photo, './pictures/customer.gif');
        } else {
            $photo = null;
        }

        return $this->render('@Customer/Backend/show.html.twig', [
            'customer' => $customer,
        ]);
    }
}
