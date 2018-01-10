<?php


namespace Asiel\AnimalBundle\Controller;


use Asiel\AnimalBundle\Entity\Picture;
use Asiel\AnimalBundle\Form\PictureType;
use Asiel\AnimalBundle\Service\PictureFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendPictureController extends Controller
{
    private $pictureFormHandler;

    public function __construct(PictureFormHandler $pictureFormHandler)
    {
        $this->pictureFormHandler = $pictureFormHandler;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        return $this->render('@Animal/Backend/Picture/index.html.twig', [
            'pictures' => $this->pictureFormHandler->getRepository()->findBy(['animal' => $this->pictureFormHandler->getAnimalRepository()->find($id)]),
        ]);
    }

    /**
     * @param int $pictureid
     * @return Response
     */
    public function showAction(int $pictureid)
    {
        return $this->render('@Animal/Backend/Picture/show.html.twig', [
            'picture' => $this->pictureFormHandler->find($pictureid),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $picture = new Picture();

        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->pictureFormHandler->create($picture, $id);

            return new RedirectResponse($this->generateUrl('backend_animal_picture_index', ['id' => $id]));
        }
        return $this->render('@Animal/Backend/Picture/create.html.twig', [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteAction(int $id)
    {
        $this->pictureFormHandler->delete($this->pictureFormHandler->find($id));

        return new Response('Command received.');
    }

}