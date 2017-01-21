<?php


namespace Asiel\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CatController extends Controller
{

    /**
     * Embedded in templates
     * @param string $option
     * @return Response
     */
    public function catCountPublicAction(string $option)
    {
        $formHandler = $this->get('asiel.frontendbundle.catformhandler');
        $result = count($formHandler->catsOption($option));

        return $this->render('@Frontend/Default/FrontendCount.html.twig', [
            'result'  => $result,
        ]);
    }

    /**
     * Ajax Call
     * @param $id integer
     * @return Response
     */
    public function showCatAction(int $id)
    {
        $formHandler = $this->get('asiel.frontendbundle.catformhandler');

        return $this->render('@Frontend/Cat/catShow.html.twig', [
            'cat'   => $formHandler->findCat($id),
        ]);
    }

    /**
     * Ajax Call
     * @param $option string
     * @return Response
     */
    public function showCatsAction(string $option)
    {
        $formHandler = $this->get('asiel.frontendbundle.catformhandler');

        return $this->render('@Frontend/Cat/catsIndex.html.twig', [
            'cats'  => $formHandler->catsOption($option),
        ]);
    }
}