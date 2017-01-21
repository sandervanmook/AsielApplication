<?php


namespace Asiel\AnimalBundle\Controller;


use Asiel\AnimalBundle\Entity\Picture;
use Asiel\AnimalBundle\Form\PictureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendPictureController extends Controller
{

    /**
     * @param int $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.pictureformhandler');

        return $this->render('@Animal/Backend/Picture/index.html.twig', [
            'pictures' => $formHandler->getRepository()->findBy(['animal' => $formHandler->getAnimalRepository()->find($id)]),
        ]);
    }

    /**
     * @param int $pictureid
     * @return Response
     */
    public function showAction(int $pictureid)
    {
        $formHandler = $this->get('asiel.animalbundle.pictureformhandler');

        return $this->render('@Animal/Backend/Picture/show.html.twig', [
            'picture' => $formHandler->find($pictureid),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.pictureformhandler');
        $picture = new Picture();

        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->create($picture, $id);

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
        $formHandler = $this->get('asiel.animalbundle.pictureformhandler');
        $formHandler->delete($formHandler->find($id));

        return new Response('Command received.');
    }

}