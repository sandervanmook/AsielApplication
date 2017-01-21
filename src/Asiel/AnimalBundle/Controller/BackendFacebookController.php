<?php


namespace Asiel\AnimalBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendFacebookController extends Controller
{

    public function indexAction(int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.facebookformhandler');
        // TODO Remove me after testing (expires after 1 hour)
        //$_SESSION['facebook_access_token'] = 'EAAQUKHKsIswBAHmsolaPJvB0XIILaZCO8sXmZBuRqu68rZB7xGi6gGWmoowjtdJQ5vSdwofitWZAYnpcbbfvZCmsG6R2jF7ro3j7cBVjnq4FWIYyGhDkQM7Ou1EG46d7tvyH60iTmZCWDQcJ2rVBCZBZCJ3Fsl3W7kgv3budCW1PZA5T1P60elkZAV0ZCJ1ZB9Q8sB8ZD';

        $loginUrl = $formHandler->getLoginUrl();

        if (isset($_SESSION['facebook_access_token'])) {
            return new RedirectResponse($this->generateUrl('backend_animal_facebook_post', ['id' => $id]));
        }

        return $this->render('@Animal/Backend/Facebook/index.html.twig', [
            'loginurl'      => $loginUrl,
        ]);
    }

    /**
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse|Response
     */
    public function postAction(Request $request, int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.facebookformhandler');

        // We are logged in
        $formHandler->setAccessToken();

        $animal = $formHandler->getAnimalRepository()->find($id);

        // Animal is already on facebook
        $facebookLink = null;
        if ($animal->getFacebookId()) {
            $facebookLink = $formHandler->getPhotoPostLink($animal->getFacebookId());
        }

        $pictures = $animal->getPictures();
        // Check If there is a picture
        $formHandler->checkNoPictures($pictures);

        // After form submit
        if ($request->get('submit')) {
            $formHandler->handleSubmit($animal);

            return new RedirectResponse($this->generateUrl('backend_animal_facebook_post', ['id' => $id]));
        }

        return $this->render('@Animal/Backend/Facebook/post.html.twig', [
            'pictures'  => $pictures,
            'facebooklink'  => $facebookLink
        ]);
    }
}