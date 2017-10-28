<?php


namespace Asiel\Shared\Service;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Entity\Picture;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\AnimalType\CatRepository;
use Asiel\AnimalBundle\Repository\AnimalType\DogRepository;
use Asiel\AnimalBundle\Repository\IncidentRepository;
use Asiel\AnimalBundle\Repository\MedicalRepository;
use Asiel\AnimalBundle\Repository\PictureRepository;
use Asiel\AnimalBundle\Repository\StatusRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\CalendarBundle\Entity\CalendarItem;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Repository\CustomerRepository;
use Asiel\EmployeeBundle\Entity\User;
use Asiel\EmployeeBundle\Entity\UserPicture;
use Asiel\EmployeeBundle\Repository\UserPictureRepository;
use Asiel\EmployeeBundle\Repository\UserRepository;
use Asiel\EmployeeBundle\Repository\WorkScheduleRepository;
use Asiel\LocationBundle\Entity\Location;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

trait BaseFormHandlerTrait
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

    public function getEm(): EntityManager
    {
        return $this->em;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    public function getRequestStack(): RequestStack
    {
        return $this->requestStack;
    }

    public function getRequestId(): int
    {
        return (int)$this->requestStack->getCurrentRequest()->get('id');
    }

    public function findAnimal(int $animalId): Animal
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);

        if (!$animal) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Dier', $animalId));
        }

        return $animal;
    }

    public function findIncident(int $incidentId): Incident
    {
        $incident = $this->em->getRepository('AnimalBundle:Incident')->find($incidentId);

        if (!$incident) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Incident', $incidentId));
        }

        return $incident;
    }

    public function findMedical(int $medicalId): Medical
    {
        $medical = $this->em->getRepository('AnimalBundle:Medical')->find($medicalId);

        if (!$medical) {
            $this->eventDispatcher->dispatch('resourcenotfound',
                new ResourceNotFoundEvent('Medisch dossier', $medicalId));
        }

        return $medical;
    }

    public function findStatus(int $statusId): Status
    {
        $status = $this->em->getRepository('AnimalBundle:Status')->find($statusId);

        if (!$status) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Status', $statusId));
        }

        return $status;
    }

    public function findCustomer(int $customerId): Customer
    {
        $customer = $this->em->getRepository('CustomerBundle:Customer')->find($customerId);

        if (!$customer) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Klant', $customerId));
        }

        return $customer;
    }

    public function findPicture(int $pictureId): Picture
    {
        $picture = $this->em->getRepository('AnimalBundle:Picture')->find($pictureId);

        if (!$picture) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Foto', $pictureId));
        }

        return $picture;
    }

    public function findTask(int $taskId): Task
    {
        $task = $this->em->getRepository('CalendarBundle:Task')->find($taskId);

        if (!$task) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Taak', $taskId));
        }

        return $task;
    }

    public function findAction(int $actionId): Action
    {
        $action = $this->em->getRepository('BookkeepingBundle:Action')->find($actionId);

        if (!$action) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Actie', $actionId));
        }

        return $action;
    }

    public function findCalendarItem(int $calendarItemId): CalendarItem
    {
        $calendarItem = $this->em->getRepository('CalendarBundle:CalendarItem')->find($calendarItemId);

        if (!$calendarItem) {
            $this->eventDispatcher->dispatch('resourcenotfound',
                new ResourceNotFoundEvent('Agendapunt', $calendarItemId));
        }

        return $calendarItem;
    }

    public function findUser(int $userId): User
    {
        $user = $this->em->getRepository('EmployeeBundle:User')->find($userId);

        if (!$user) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Gebruiker', $userId));
        }

        return $user;
    }

    public function findUserPicture(int $userPictureId): UserPicture
    {
        $userPicture = $this->em->getRepository('EmployeeBundle:UserPicture')->find($userPictureId);

        if (!$userPicture) {
            $this->eventDispatcher->dispatch('resourcenotfound',
                new ResourceNotFoundEvent('Gebruikersfoto', $userPictureId));
        }

        return $userPicture;
    }

    public function findCat(int $catId) : Cat
    {
        $cat = $this->em->getRepository('AnimalBundle:AnimalType\Cat')->find($catId);

        if (!$cat) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Kat', $catId));
        }

        return $cat;
    }

    public function findDog(int $dogId) : Dog
    {
        $dog = $this->em->getRepository('AnimalBundle:AnimalType\Dog')->find($dogId);

        if (!$dog) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Hond', $dogId));
        }

        return $dog;
    }

    public function findLocation(int $locationId) : Location
    {
        $location = $this->em->getRepository('LocationBundle:Location')->find($locationId);

        if (!$location) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Locatie', $locationId));
        }

        return $location;
    }

    public function findTransaction(int $transactionId) : Transaction
    {
        $transaction = $this->em->getRepository('BookkeepingBundle:Transaction')->find($transactionId);

        if (!$transaction) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Transactie', $transactionId));
        }

        return $transaction;
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }

    public function getIncidentRepository(): IncidentRepository
    {
        return $this->em->getRepository('AnimalBundle:Incident');
    }

    public function getMedicalRepository(): MedicalRepository
    {
        return $this->em->getRepository('AnimalBundle:Medical');
    }

    public function getStatusRepository(): StatusRepository
    {
        return $this->em->getRepository('AnimalBundle:Status');
    }

    public function getCustomerRepository(): CustomerRepository
    {
        return $this->em->getRepository('CustomerBundle:Customer');
    }

    public function getPictureRepository(): PictureRepository
    {
        return $this->em->getRepository('AnimalBundle:Picture');
    }

    public function getBookkeepingSettingsRepository(): BookkeepingSettingsRepository
    {
        return $this->em->getRepository('BackendBundle:BookkeepingSettings');
    }

    public function getUserRepository(): UserRepository
    {
        return $this->em->getRepository('EmployeeBundle:User');
    }

    public function getUserPictureRepository(): UserPictureRepository
    {
        return $this->em->getRepository('EmployeeBundle:UserPicture');
    }

    public function getWorkScheduleRepository(): WorkScheduleRepository
    {
        return $this->em->getRepository('EmployeeBundle:WorkSchedule');
    }

    public function getCatRepository(): CatRepository
    {
        return $this->em->getRepository('AnimalBundle:AnimalType\Cat');
    }

    public function getDogRepository(): DogRepository
    {
        return $this->em->getRepository('AnimalBundle:AnimalType\Dog');
    }
}