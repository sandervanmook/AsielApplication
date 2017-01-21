<?php


namespace Asiel\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DogController extends Controller
{

    /**
     * Embedded in templates
     * @param string $option
     * @return Response
     */
    public function dogCountPublicAction(string $option)
    {
        $formHandler = $this->get('asiel.frontendbundle.dogformhandler');
        $result = count($formHandler->dogsOption($option));

        return $this->render('@Frontend/Default/FrontendCount.html.twig', [
            'result'  => $result,
        ]);
    }

    /**
     * Ajax Call
     * @param $id integer
     * @return Response
     */
    public function showDogAction(int $id)
    {
        $formHandler = $this->get('asiel.frontendbundle.dogformhandler');
        return $this->render('@Frontend/Dog/dogShow.html.twig', [
            'dog'   => $formHandler->findDog($id),
        ]);
    }

    /**
     * Ajax Call
     * @param $option string
     * @return Response
     */
    public function showDogsAction($option)
    {
        $formHandler = $this->get('asiel.frontendbundle.dogformhandler');

        return $this->render('@Frontend/Dog/dogsIndex.html.twig', [
            'dogs'  => $formHandler->dogsOption($option),
        ]);
    }

}