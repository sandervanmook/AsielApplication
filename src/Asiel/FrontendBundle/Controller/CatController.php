<?php


namespace Asiel\FrontendBundle\Controller;


use Asiel\FrontendBundle\Service\CatFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CatController extends Controller
{
    private $catFormHandler;

    public function __construct(CatFormHandler $catFormHandler)
    {
        $this->catFormHandler = $catFormHandler;
    }

    /**
     * Embedded in templates
     * @param string $option
     * @return Response
     */
    public function catCountPublicAction(string $option)
    {
        $result = count($this->catFormHandler->catsOption($option));

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
        return $this->render('@Frontend/Cat/catShow.html.twig', [
            'cat'   => $this->catFormHandler->findCat($id),
        ]);
    }

    /**
     * Ajax Call
     * @param $option string
     * @return Response
     */
    public function showCatsAction(string $option)
    {
        return $this->render('@Frontend/Cat/catsIndex.html.twig', [
            'cats'  => $this->catFormHandler->catsOption($option),
        ]);
    }
}