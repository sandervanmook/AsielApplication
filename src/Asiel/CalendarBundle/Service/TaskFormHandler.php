<?php


namespace Asiel\CalendarBundle\Service;


use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\Task;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class TaskFormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
    }


    /**
     * @param string $dateDue
     * @param string $origin
     */
    public function createByEvent($dateDue, $origin)
    {
        $task = new Task();
        $animal = $this->getAnimalRepository()->find($this->getRequestId());

        $date = new DateTime();
        $eventDateDue = $date->add(new DateInterval($dateDue));

        $title = $origin['title'];
        $description = $origin['description'];

        // Create Task
        $task->setDateCreated(new DateTime());
        $task->setDateDue($eventDateDue);
        $task->setTitle($title);
        $task->setDescription($description);
        $task->setIsComplete(false);
        $task->setAnimal($animal);
        $task->setCreatedBy('Systeem');

        // Save in DB
        $this->em->persist($task);
        $this->em->flush();

        // Send alert
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::INFO, "Taak {$title} is aangemaakt door het systeem."));
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }

    public function getRequestId() : int
    {
        return (int)$this->requestStack->getCurrentRequest()->get('id');
    }
}