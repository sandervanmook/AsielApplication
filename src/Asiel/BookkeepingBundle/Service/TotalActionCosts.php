<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use DateTime;
use Doctrine\ORM\EntityManager;

class TotalActionCosts
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

    public function getTotalCosts(): int
    {
        $this->calculate();
        return $this->totalCosts;
    }

    protected function calculate()
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
                $dayOfBirth = $this->animal->getDayOfBirth();
                $today = new DateTime('today');
                $interval = $dayOfBirth->diff($today);
                $differenceInMonths = $interval->m;
                $differenceInYears = $interval->y;

                if (!$this->status->getMunicipalityaffiliation()) {
                    // Municipality is unaffiliated

                    // Determine animal type first
                    // Dogs
                    if ($this->animal->getAnimalType() == 'Dog' || $this->animal->getAnimalType() == 'Puppy') {
                        if ($differenceInMonths <= 3) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogUnaffiliatedPuppy();
                        }
                        if ($this->animal->isPuppy()) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getpriceAbandonedDogUnaffiliatedYoungerThanOne();
                        }
                        if ($this->animal->isDog()) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getpriceAbandonedDogUnaffiliatedOlderThanOne();
                        }

                        // Add additions (add them to the total costs)
                        if ($this->status->getNeedsChipping()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogUnaffiliatedAdditionNotChipped();
                        }
                        if ($this->status->isNeedsVaccines()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogUnaffiliatedAdditionNotVaccinated();
                        }
                        if ($this->status->getNeedsFurTreatment() == 'smalldog') {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog();
                        }
                        if ($this->status->getNeedsFurTreatment() == 'largedog') {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog();
                        }
                        if ($this->status->getIsIll()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogUnaffiliatedAdditionIll();
                        }
                    }
                    // Cats
                    if ($this->animal->getAnimalType() == 'Cat' || $this->animal->getAnimalType() == 'Kitten') {
                        if ($differenceInMonths <= 1) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatUnaffiliatedKitten();
                        }
                        if ($this->animal->isKitten() && $differenceInMonths <= 3) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths();
                        }
                        if ($this->animal->isCat() && $differenceInYears > 10) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatUnaffiliatedOlderThanTenYears();
                        }
                        if (($this->animal->getClassName() == 'Cat') &&
                            ($differenceInMonths > 3) &&
                            ($differenceInYears <= 10)
                        ) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears();
                        }

                        // Add additions (add them to the total costs)
                        if ($this->status->getNeedsChipping()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatUnaffiliatedAdditionNotChipped();
                        }
                        if ($this->status->isNeedsVaccines()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatUnaffiliatedAdditionNotVaccinated();
                        }
                        if ($this->status->isNeedsSterilization()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatUnaffiliatedAdditionNeedsSterilization();
                        }
                    }

                } else {
                    // Municipality is affiliated

                    // Determine animal type first
                    // Dogs
                    if ($this->animal->getAnimalType() == 'Dog' || $this->animal->getAnimalType() == 'Puppy') {
                        if ($this->animal->isPuppy() && $differenceInMonths <= 3) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogAffiliatedPuppy();
                        }
                        if ($this->animal->isPuppy()) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getpriceAbandonedDogAffiliatedYoungerThanOne();
                        }
                        if ($this->animal->isDog()) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getpriceAbandonedDogAffiliatedOlderThanOne();
                        }

                        // Add additions (add them to the total costs)
                        if ($this->status->getNeedsChipping()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogAffiliatedAdditionNotChipped();
                        }
                        if ($this->status->isNeedsVaccines()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogAffiliatedAdditionNotVaccinated();
                        }
                        if ($this->status->getNeedsFurTreatment() == 'smalldog') {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog();
                        }
                        if ($this->status->getNeedsFurTreatment() == 'largedog') {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog();
                        }
                        if ($this->status->getIsIll()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDogAffiliatedAdditionIll();
                        }
                    }
                    // Cats
                    if ($this->animal->getAnimalType() == 'Cat' || $this->animal->getAnimalType() == 'Kitten') {
                        if ($differenceInMonths <= 1) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatAffiliatedKitten();
                        }
                        if ($this->animal->isKitten() && $differenceInMonths <= 3) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatAffiliatedYoungerThanThreeMonths();
                        }
                        if ($this->animal->isCat() && $differenceInYears > 10) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatAffiliatedOlderThanTenYears();
                        }
                        if (($this->animal->getClassName() == 'Cat') &&
                            ($differenceInMonths > 3) &&
                            ($differenceInYears <= 10)
                        ) {
                            $this->totalCosts = $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears();
                        }

                        // Add additions (add them to the total costs)
                        if ($this->status->getNeedsChipping()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatAffiliatedAdditionNotChipped();
                        }
                        if ($this->status->isNeedsVaccines()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatAffiliatedAdditionNotVaccinated();
                        }
                        if ($this->status->isNeedsSterilization()) {
                            $this->totalCosts += $this->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCatAffiliatedAdditionNeedsSterilization();
                        }
                    }
                }
                break;
            default :
                $this->totalCosts = 999;
        }
    }

    protected function getEm()
    {
        return $this->em;
    }

    protected function getBookkeepingSettingsRepository(): BookkeepingSettingsRepository
    {
        return $this->getEm()->getRepository('BackendBundle:BookkeepingSettings');
    }

}