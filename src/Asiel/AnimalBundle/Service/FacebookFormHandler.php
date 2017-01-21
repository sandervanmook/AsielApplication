<?php


namespace Asiel\AnimalBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class FacebookFormHandler
{
    private $appId;
    private $appSecret;
    private $fb;
    private $fbHelper;
    private $entityManager;
    private $router;
    private $requestStack;
    private $eventDispatcher;

    public function __construct(
        $appId,
        $appSecret,
        EntityManager $entityManager,
        Router $router,
        RequestStack $requestStack,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->setup();

        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->requestStack = $requestStack;
        // Load setup() first!
        $this->fbHelper = $this->fb->getRedirectLoginHelper();
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * setup facebook instance
     */
    public function setup()
    {
        $fb = new Facebook([
            'app_id' => $this->getAppId(),
            'app_secret' => $this->getAppSecret(),
            'default_graph_version' => 'v2.8',
        ]);

        $this->fb = $fb;
    }

    /**
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return mixed
     */
    public function getLoginUrl()
    {
        $permissions = ['publish_actions'];
        $baseUrl = $this->router->generate('backend_animal_facebook_post',
            ['id' => $this->requestStack->getCurrentRequest()->get('id')], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->fbHelper->getLoginUrl($baseUrl, $permissions);
    }

    /**
     * Set session var for access token
     */
    public function setAccessToken()
    {
        try {
            $accessToken = $this->fbHelper->getAccessToken();
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (isset($accessToken)) {
            // Logged in
            $_SESSION['facebook_access_token'] = (string)$accessToken;
            $this->fb->setDefaultAccessToken($accessToken);
        }
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->entityManager->getRepository('AnimalBundle:Animal');
    }

    /**
     * @param integer $facebookId
     * @return string
     */
    public function getPhotoPostLink(int $facebookId)
    {
        return sprintf('https://www.facebook.com/photo.php?fbid=%s', $facebookId);
    }

    /**
     * @param Collection $pictures
     */
    public function checkNoPictures(Collection $pictures)
    {
        if ($pictures->isEmpty()) {
            $this->eventDispatcher->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER, "Er zijn nog geen foto's aanwezig"));
        }
    }

    /**
     * @param Animal $animal
     * @return UserAlertEvent
     */
    public function handleSubmit(Animal $animal)
    {
        $message = $this->requestStack->getCurrentRequest()->get('message');
        $pictureId = $this->requestStack->getCurrentRequest()->get('picture');

        if (!$pictureId) {
            return $this->eventDispatcher->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER, 'Geen foto geselecteerd.'));
        }

        if (!$message) {
            return $this->eventDispatcher->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER, 'Geen bericht ingevoerd.'));
        }

        $messageWithLink = sprintf('%s %s', $message, $this->publicLinkToAnimal($animal->getId()));

        $this->postPhoto($messageWithLink, $pictureId, $animal);
    }

    /**
     * @param integer $animalId
     * @return string
     */
    public function publicLinkToAnimal($animalId)
    {
        return $this->router->generate('frontend_facebook_link', ['id' => $animalId],
            UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * @param $message
     * @param $pictureId
     * @param Animal $animal
     * @return UserAlertEvent
     */
    public function postPhoto($message, $pictureId, Animal $animal)
    {
        $picture = $this->entityManager->getRepository('AnimalBundle:Picture')->find($pictureId);
        $relativePath = $this->router->generate('frontend_index', [],
                UrlGeneratorInterface::ABSOLUTE_URL) . $picture->getPublicURL();

        $data = [
            'message' => $message,
            'source' => $this->fb->fileToUpload($relativePath),
        ];

        try {
            $response = $this->fb->post('/me/photos/', $data, $this->getAccessToken());
        } catch (FacebookResponseException $e) {
            return $this->eventDispatcher->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER, "Er is een fout opgetreden:" . $e->getMessage()));
        } catch (FacebookSDKException $e) {
            return $this->eventDispatcher->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER, "Er is een fout opgetreden:" . $e->getMessage()));
        }

        $graphNode = $response->getGraphNode();

        $animal->setFacebookId($graphNode['id']);
        $this->entityManager->flush();

        return $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Bericht is op Facebook geplaatst.'));
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $_SESSION['facebook_access_token'];
    }

}