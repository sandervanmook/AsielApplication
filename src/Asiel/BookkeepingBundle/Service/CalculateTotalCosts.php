<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Doctrine\ORM\EntityManager;

class CalculateTotalCosts
{
    private $animal;
    private $actionType;
    private $totalCosts;
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    private function calculate()
    {
        switch ($this->actionType) {
            case 'Adopted':
                if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyAKitten())) {
                    return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedKitten();
                }
                if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyACat())) {
                    return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedCat();
                }
                if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyADog())) {
                    return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedDog();
                }
                if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyAPuppy())) {
                    return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedPuppy();
                }
                break;

        }
    }

    public function getTotalCosts() : int
    {
        return $this->totalCosts;
    }


}