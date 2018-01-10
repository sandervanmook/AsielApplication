<?php


namespace Asiel\FrontendBundle\Controller;


use Asiel\FrontendBundle\Service\DogFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DogController extends Controller
{
    private $dogFormHandler;

    public function __construct(DogFormHandler $dogFormHandler)
    {
        $this->dogFormHandler = $dogFormHandler;
    }

    /**
     * Embedded in templates
     * @param string $option
     * @return Response
     */
    public function dogCountPublicAction(string $option)
    {
        $result = count($this->dogFormHandler->dogsOption($option));

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
        return $this->render('@Frontend/Dog/dogShow.html.twig', [
            'dog'   => $this->dogFormHandler->findDog($id),
        ]);
    }

    /**
     * Ajax Call
     * @param $option string
     * @return Response
     */
    public function showDogsAction($option)
    {
        return $this->render('@Frontend/Dog/dogsIndex.html.twig', [
            'dogs'  => $this->dogFormHandler->dogsOption($option),
        ]);
    }

}