<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Doctrine\ORM\EntityManager;

class TotalCosts
{
    private $animal;
    private $actionType;
    private $totalCosts;
    private $em;
    private $status;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function setAnimal(Animal $animal)
    {
        $this->animal = $animal;
    }

    public function setActionType(string $actionType)
    {
        $this->actionType = $actionType;
    }

    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    public function getTotalCosts() : int
    {
        $this->calculate();
        return $this->totalCosts;
    }

    private function calculate()
    {
        switch ($this->actionType) {
            case 'Adopted':
                if ($this->animal->isKitten()) {
                    $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedKitten();
                }
                if ($this->animal->isCat()) {
                    $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedCat();
                }
                if ($this->animal->isDog()) {
                    $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedDog();
                }
                if ($this->animal->isPuppy()) {
                    $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedPuppy();
                }
                break;
            case 'Abandoned' :




                break;
            default :
                $this->totalCosts = 999;
        }
    }

    protected function getEm()
    {
        return $this->em;
    }

    private function getBookkeepingSettingsRepository() : BookkeepingSettingsRepository
    {
        return $this->getEm()->getRepository('BackendBundle:BookkeepingSettings');
    }

}