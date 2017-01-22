<?php


namespace Asiel\FrontendBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\FrontendBundle\Form\SearchAnimalType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;

class DefaultFormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;
    protected $formFactory;
    protected $router;
    protected $mailer;
    protected $contact_email;
    protected $twig;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack,
        FormFactory $formFactory,
        Router $router,
        \Swift_Mailer $mailer,
        $contact_email,
        TwigEngine $twig
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->mailer = $mailer;
        $this->contact_email = $contact_email;
        $this->twig = $twig;
    }

    /**
     * @return mixed
     */
    public function createSearchForm()
    {
        $searchForm =
            $this->formFactory
                ->createBuilder(SearchAnimalType::class)
                ->setAction($this->router->generate('frontend_animal_search'))
                ->setMethod('POST')
                ->getForm();

        return $searchForm;
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }

    /**
     * @param $searchForm
     * @return array
     */
    public function getSearchArray($searchForm)
    {
        $search = [];
        $search['type'] = $searchForm->get('type')->getData();
        $search['gender'] = $searchForm->get('gender')->getData();
        $search['age'] = $searchForm->get('age')->getData();

        return $search;
    }

    /**
     * @param $form
     */
    public function sendContactFormEmail($form)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Bericht Contactformulier')
            ->setFrom($form->get('email')->getData())
            ->setTo($this->contact_email)
            ->setBody(
                $this->twig->render('@Frontend/Default/contactFormEmail.html.twig', [
                    'reason' => $form->get('reason')->getData(),
                    'name' => $form->get('name')->getData(),
                    'email' => $form->get('email')->getData(),
                    'message' => $form->get('message')->getData(),
                ]),
                'text/html'
            );
        $this->mailer->send($message);
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Uw bericht is verzonden.'));
    }

    /**
     * @param $id
     * @return null|Animal
     */
    public function findAnimal(int $id)
    {
        $animal = $this->getAnimalRepository()->findBy(['id' => $id, 'visiblePublic' => true]);

        if (!$animal) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Dier', $id));
        }

        return $animal;
    }
}