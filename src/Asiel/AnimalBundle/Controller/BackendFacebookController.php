<?php


namespace Asiel\AnimalBundle\Controller;


use Asiel\AnimalBundle\Service\FacebookFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendFacebookController extends Controller
{
    private $facebookFormHandler;

    public function __construct(FacebookFormHandler $facebookFormHandler)
    {
        $this->facebookFormHandler = $facebookFormHandler;
    }

    public function indexAction(int $id)
    {
        $loginUrl = $this->facebookFormHandler->getLoginUrl();

        if (isset($_SESSION['facebook_access_token'])) {
            return new RedirectResponse($this->generateUrl('backend_animal_facebook_post', ['id' => $id]));
        }

        return $this->render('@Animal/Backend/Facebook/index.html.twig', [
            'loginurl' => $loginUrl,
        ]);
    }

    /**
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse|Response
     */
    public function postAction(Request $request, int $id)
    {
        // We are logged in
        $this->facebookFormHandler->setAccessToken();

        $animal = $this->facebookFormHandler->getAnimalRepository()->find($id);

        // Animal is already on facebook
        $facebookLink = null;
        if ($animal->getFacebookId()) {
            $facebookLink = $this->facebookFormHandler->getPhotoPostLink($animal->getFacebookId());
        }

        $pictures = $animal->getPictures();
        // Check If there is a picture
        $this->facebookFormHandler->checkNoPictures($pictures);

        // After form submit
        if ($request->get('submit')) {
            $this->facebookFormHandler->handleSubmit($animal);

            return new RedirectResponse($this->generateUrl('backend_animal_facebook_post', ['id' => $id]));
        }

        return $this->render('@Animal/Backend/Facebook/post.html.twig', [
            'pictures' => $pictures,
            'facebooklink' => $facebookLink
        ]);
    }
}