<?php

namespace Asiel\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BackendCustomerController extends Controller
{


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
