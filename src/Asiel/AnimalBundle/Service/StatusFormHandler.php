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
use Asiel\Shared\Service\BaseFormHandler;
use Symfony\Component\Form\Form;

class StatusFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function find(int $statusId): Status
    {
        return $this->baseFormHandler->findStatus($statusId);
    }

    public function delete(Status $status)
    {
        $this->baseFormHandler->getEm()->remove($status);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Status verwijderd.'));
    }

    /**
     * Check if the animal has no state, if it has, show message.
     * @param int $animalId
     */
    public function checkNoState(int $animalId)
    {
        if (!$this->getAnimalRepository()->find($animalId)) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('resourcenotfound',
                new ResourceNotFoundEvent('Status', 1));
        }
        if ($this->getAnimalRepository()->find($animalId)->getStatus()->isEmpty()) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    'U moet minimaal (en als eerste) een "Onsite" status aanmaken.'));
        }
    }

    public function getRepository(): StatusRepository
    {
        return $this->baseFormHandler->getStatusRepository();
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->baseFormHandler->getAnimalRepository();
    }

    public function createStatusTypeCheck(int $animalId, string $type)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($this->baseFormHandler->findAnimal($animalId));
        $changeToState = 'changeTo' . $type;
        $decision = call_user_func([$stateMachine, $changeToState]);
        if (!$decision) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
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
            $status->setOwner($this->baseFormHandler->findCustomer($form->get('owner')->getData()));
        }

        // Abandon status
        if ($form->getName() == 'asielbundle_statustype_abandoned') {
            // Set the customer who abandons.
            if ($form->has('abandonedBy') && (!is_null($form->get('abandonedBy')->getData()))) {
                $status->setAbandonedBy($this->baseFormHandler->findCustomer($form->get('abandonedBy')->getData()));
            }
            // If we need to chip the animal, create a task.
            if ($form->has('needsChipping') && (($form->get('needsChipping')->getData()))) {
                $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                    new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_CHIPPED));
            }
            // If we need to vaccine the animal, create a task.
            if ($form->has('needsVaccines') && (($form->get('needsVaccines')->getData()))) {
                $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                    new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_VACCINE));
            }
            // If we need to sterilize the animal, create a task.
            if ($form->has('needsSterilization') && (($form->get('needsSterilization')->getData()))) {
                $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                    new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_STERILIZE));
            }
            // If the animal needs a passport, create a task.
            if ($form->has('needsPassport') && (($form->get('needsPassport')->getData()))) {
                $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                    new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_PASSPORT));
            }
        }
        // End abandon status

        // Found status
        if ($form->getName() == 'asielbundle_statustype_found') {
            // Create reminder checkup task
            $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::THREEDAYS, Found::FOUND_CHECKUP));

            // Create available for adoption task.
            $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::FIFTEENDAYS, Found::FOUND_AVAILABLE));

            // Set the customer who found the animal.
            if ($form->has('foundBy') && (!is_null($form->get('foundBy')->getData()))) {
                $status->setFoundBy($this->baseFormHandler->findCustomer($form->get('foundBy')->getData()));
            }
            // If we need to chip the animal, create a task.
            if ($form->has('needsChipping') && (($form->get('needsChipping')->getData()))) {
                $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                    new TaskEvent($currentAnimal, Task::TOMORROW, Found::FOUND_CHIPPED));
            }
        }
        // End found status

        $this->baseFormHandler->getEm()->persist($status);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De status is aangemaakt.'));
    }

    public function removeArchivedStatus(Status $status)
    {
        $this->baseFormHandler->getEm()->remove($status);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Gearchiveerde status verwijderd.'));
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
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, $message));
    }

    /**
     * @param Status $status
     */
    public function removeActiveStatus(Status $status)
    {
        $this->baseFormHandler->getEm()->remove($status);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Actieve status verwijderd.'));
    }
}
