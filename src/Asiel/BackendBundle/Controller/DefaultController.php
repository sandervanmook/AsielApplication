<?php

namespace Asiel\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $browser = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;

        if (!strpos($browser,'Chrome')) {
            $warning = 'We zien dat u geen Chrome als browser gebruikt. 
            Om optimaal gebruik van deze applicatie te maken adviseren wij u Chrome te gebruiken.
            Mocht u toch een andere browser gebruiken zullen de meeste functies normaal werken.
            Het afdrukken van facturen bijvoorbeeld zou problemen kunnen geven.';
        } else {
            $warning = null;
        }

        $em = $this->getDoctrine();
        $animalRepository = $em->getRepository('AnimalBundle:Animal');
        $customerRepository = $em->getRepository('CustomerBundle:Customer');
        $employeeRepository = $em->getRepository('EmployeeBundle:User');

        $amountAnimalsOnsite = count($animalRepository->onsiteAnimals());
        $amountAnimalsOffsite = count($animalRepository->onsiteAnimals());
        $amountCustomers = count($customerRepository->findAll());
        $amountEmployees = count($employeeRepository->findAll());

        return $this->render('BackendBundle:Default:index.html.twig', [
            'browser' => $warning,
            'amountanimalsonsite' => $amountAnimalsOnsite,
            'amountanimalsoffsite' => $amountAnimalsOffsite,
            'amountcustomers' => $amountCustomers,
            'amountemployees' => $amountEmployees,
        ]);
    }

    public function helpAction()
    {
        return $this->render('@Backend/Help/index.html.twig');
    }
}
