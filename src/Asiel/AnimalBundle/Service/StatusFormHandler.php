<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\StatusRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\CalendarBundle\Event\TaskEvent;
use Asiel\CustomerBundle\Repository\CustomerRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RequestStack;

class StatusFormHandler
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

    public function find(int $statusId)
    {
        $status = $this->em->getRepository('AnimalBundle:Status')->find($statusId);

        if (!$status) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Status', $statusId));
        }

        return $status;
    }

    public function delete(Status $status)
    {
        $this->em->remove($status);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Status verwijderd.'));
    }

    /**
     * Check if the animal has no state, if it has, show message.
     * @param int $animalId
     */
    public function checkNoState(int $animalId)
    {
        if (!$this->getAnimalRepository()->find($animalId)) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Status', 1));
        }
        if ($this->getAnimalRepository()->find($animalId)->getStatus()->isEmpty()) {
            $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::DANGER,
                'U moet minimaal (en als eerste) een "Onsite" status aanmaken.'));
        }
    }

    public function getRepository(): StatusRepository
    {
        return $this->em->getRepository('AnimalBundle:Status');
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }

    public function getCustomerRepository() : CustomerRepository
    {
        return $this->em->getRepository('CustomerBundle:Customer');
    }

    public function createStatusTypeCheck(int $animalId, string $type)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($this->getAnimalRepository()->find($animalId));
        $changeToState = 'changeTo' . $type;
        $decision = call_user_func([$stateMachine, $changeToState]);
        if (!$decision) {
            $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::DANGER,
                "Vanwege de huidige status van dit dier mag U dit type status niet aanmaken."));
            return false;
        }

        return true;
    }

    public function createStatus(Status $status, Animal $currentAnimal, Form $form)
    {
        // Archive all states so the new one will be the new active state
        $this->getRepository()->setStatesArchived($currentAnimal->getStatus());

        // Bind the animal to this status
        $status->setAnimal($currentAnimal);
        // The new status should be active
        $status->setArchived(false);

        // Set the owner. (Returned Owner status)
        if ($form->has('owner') && (!is_null($form->get('owner')->getData()))) {
            $status->setOwner($this->getCustomerRepository()->find($form->get('owner')->getData()));
        }

        // Abandon status
        if ($form->getName() == 'asielbundle_statustype_abandoned') {
            // Set the customer who abandons.
            if ($form->has('abandonedBy') && (!is_null($form->get('abandonedBy')->getData()))) {
                $status->setAbandonedBy($this->getCustomerRepository()->find($form->get('abandonedBy')->getData()));
            }
            // If we need to chip the animal, create a task.
            if ($form->has('needsChipping') && (($form->get('needsChipping')->getData()))) {
                $this->eventDispatcher->dispatch('createtask', new TaskEvent(Task::TOMORROW, Abandoned::ABANDON_CHIPPED));
            }
            // If we need to vaccine the animal, create a task.
            if ($form->has('needsVaccines') && (($form->get('needsVaccines')->getData()))) {
                $this->eventDispatcher->dispatch('createtask', new TaskEvent(Task::TOMORROW, Abandoned::ABANDON_VACCINE));
            }
            // If we need to sterilize the animal, create a task.
            if ($form->has('needsSterilization') && (($form->get('needsSterilization')->getData()))) {
                $this->eventDispatcher->dispatch('createtask', new TaskEvent(Task::TOMORROW, Abandoned::ABANDON_STERILIZE));
            }
            // If the animal needs a passport, create a task.
            if ($form->has('needsPassport') && (($form->get('needsPassport')->getData()))) {
                $this->eventDispatcher->dispatch('createtask', new TaskEvent(Task::TOMORROW, Abandoned::ABANDON_PASSPORT));
            }
        }
        // End abandon status

        // Found status
        if ($form->getName() == 'asielbundle_statustype_found') {
            // Create reminder checkup task
            $this->eventDispatcher->dispatch('createtask', new TaskEvent(Task::THREEDAYS, Found::FOUND_CHECKUP));

            // Create available for adoption task.
            $this->eventDispatcher->dispatch('createtask', new TaskEvent(Task::FIFTEENDAYS, Found::FOUND_AVAILABLE));

            // Set the customer who found the animal.
            if ($form->has('foundBy') && (!is_null($form->get('foundBy')->getData()))) {
                $status->setFoundBy($this->getCustomerRepository()->find($form->get('foundBy')->getData()));
            }
            // If we need to chip the animal, create a task.
            if ($form->has('needsChipping') && (($form->get('needsChipping')->getData()))) {
                $this->eventDispatcher->dispatch('createtask', new TaskEvent(Task::TOMORROW, Found::FOUND_CHIPPED));
            }
        }
        // End found status

        // If someone adopted the animal set the right customer. (Adopted status)
        if ($form->has('customer') && (!is_null($form->get('customer')->getData()))) {
            $status->setCustomer($this->getCustomerRepository()->find($form->get('customer')->getData()));
        }

        $this->em->persist($status);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'De status is aangemaakt.'));
    }

    public function removeArchivedStatus(Status $status)
    {
        $this->em->remove($status);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Gearchiveerde status verwijderd.'));
    }

    /**
     * @param $states
     * @return array
     */
    public function getIdsFromStates($states)
    {
        foreach ($states as $state) {
            $id[] = $state->getId();
        }

        return $id;
    }

    /**
     * @param $message string
     */
    public function setSuccessMessage($message)
    {
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, $message));
    }

    /**
     * @param Status $status
     */
    public function removeActiveStatus(Status $status)
    {
        $this->em->remove($status);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Actieve status verwijderd.'));
    }
}
