<?php

namespace Asiel\CustomerBundle\Controller;

use Asiel\CustomerBundle\Entity\BusinessCustomer;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Entity\PrivateCustomer;
use Asiel\CustomerBundle\Form\BusinessCustomerType;
use Asiel\CustomerBundle\Form\CustomerType;
use Asiel\CustomerBundle\Form\PrivateCustomerType;
use Asiel\CustomerBundle\Form\SearchCustomerType;
use Asiel\CustomerBundle\Service\CustomerFormHandler;
use Asiel\Shared\Filter\Customer\CustomerCitizenservicenumberFilter;
use Asiel\Shared\Filter\Customer\CustomerCompanynameFilter;
use Asiel\Shared\Filter\Customer\CustomerLastnameFilter;
use Asiel\Shared\Filter\Customer\CustomerMunicipalityFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendCustomerController extends Controller
{
    private $customerFormHandler;

    public function __construct(CustomerFormHandler $customerFormHandler)
    {
        $this->customerFormHandler = $customerFormHandler;
    }

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
        $allCustomers = $this->customerFormHandler->getRepository()->findAll();

        $searchArray['lastname'] = $request->get('lastname');
        $searchArray['citizenservicenumber'] = $request->get('citizenservicenumber');
        $searchArray['municipality'] = $request->get('municipality');
        $searchArray['companyname'] = $request->get('companyname');

        $customerIterator = [];
        $searchArray['lastname'] ? $customerIterator = new CustomerLastnameFilter(new \ArrayIterator($allCustomers), $searchArray) : [];
        $searchArray['citizenservicenumber'] ? $customerIterator = new CustomerCitizenservicenumberFilter(new \ArrayIterator($allCustomers), $searchArray) : [];
        $searchArray['municipality'] ? $customerIterator = new CustomerMunicipalityFilter(new \ArrayIterator($allCustomers), $searchArray) : [];
        $searchArray['companyname'] ? $customerIterator = new CustomerCompanynameFilter(new \ArrayIterator($allCustomers), $searchArray) : [];


        switch ($requestby) {
            case 'statisticsbundle' :
                return $this->render('@Statistics/Backend/customerSearchResult.html.twig', [
                    'result' => $customerIterator,
                ]);
            case 'bookkeepingbundle_action' :
                return $this->render('@Bookkeeping/Backend/Action/searchCustomerResult.html.twig', [
                    'result' => $customerIterator,
                ]);
            case 'bookkeepingbundle_transaction' :
                return $this->render('@Bookkeeping/Backend/Transaction/searchCustomerResult.html.twig', [
                    'result' => $customerIterator,
                ]);
            case 'bookkeepingbundle_invoiceledger' :
                return $this->render('@Bookkeeping/Backend/InvoiceLedger/searchCustomerResult.html.twig', [
                    'result' => $customerIterator,
                ]);
            default:
                return $this->render('@Customer/Backend/searchResult.html.twig', [
                    'result' => $customerIterator,
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
        $customer = $this->customerFormHandler->findCustomer($id);
        $customerType = $customer->getClassName();

        $form = $this->createForm('Asiel\CustomerBundle\Form\\'.$customerType.'Type', $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->has('idcard')) {
                $idCard = $form->get('idcard')->getData();
            } else {
                $idCard = null;
            }

            $this->customerFormHandler->edit($customer, $idCard);

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
        $privateCustomer = new PrivateCustomer();

        $form = $this->createForm(PrivateCustomerType::class, $privateCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idCard = $form->get('idcard')->getData();
            $this->customerFormHandler->createPrivate($privateCustomer, $idCard);

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
        $businessCustomer = new BusinessCustomer();

        $form = $this->createForm(BusinessCustomerType::class, $businessCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->customerFormHandler->createBusiness($businessCustomer);

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
        $customer = $this->customerFormHandler->findCustomer($customerid);

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
