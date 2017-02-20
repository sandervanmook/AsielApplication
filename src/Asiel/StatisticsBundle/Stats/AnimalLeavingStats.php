<?php


namespace Asiel\StatisticsBundle\Stats;


class AnimalLeavingStats
{
    private $allAnimals;
    private $searchArray;
    private $filterResult;

    public function __construct($allAnimals, $searchArray)
    {
        $this->allAnimals = $allAnimals;
        $this->searchArray = $searchArray;
    }

    public function getFilterResult()
    {
        return $this->filterResult;
    }

    public function filter()
    {
        $this->filterDate();
    }

    /**
     * First filter, use allAnimals
     */
    private function filterDate()
    {
        $result = [];
        $dateStart = $this->searchArray['datestart']->getTimestamp();
        $dateEnd = $this->searchArray['dateend']->getTimestamp();

        if (!empty($this->allAnimals)) {
            foreach ($this->allAnimals as $animal) {
                $admissionDate = $animal->getAdmissionDate();
                $dayOfBirth = $animal->getDayOfBirth();

                $interval = $admissionDate->diff($dayOfBirth);
                $ageAtRegistration = $interval->y;

                $admissionDate = $animal->getAdmissionDate()->getTimestamp();
                if (($admissionDate >= $dateStart) &&
                    ($admissionDate <= $dateEnd)
                ) {
                    switch ($animal->getActiveState()->getClassName()) {
                        case 'Deceased':
                            if ($animal->getClassName() == 'Dog') {
                                if ($ageAtRegistration <= 1) {
                                    $result['Deceased']['Puppy'][] = $animal;
                                } else {
                                    $result['Deceased']['Dog'][] = $animal;
                                }
                            }
                            if ($animal->getClassName() == 'Cat') {
                                if ($ageAtRegistration <= 1) {
                                    $result['Deceased']['Kitten'][] = $animal;
                                } else {
                                    $result['Deceased']['Cat'][] = $animal;
                                }
                            }
                            break;
                        case 'ReturnedOwner':
                            if ($animal->getClassName() == 'Dog') {
                                if ($ageAtRegistration <= 1) {
                                    $result['ReturnedOwner']['Puppy'][] = $animal;
                                } else {
                                    $result['ReturnedOwner']['Dog'][] = $animal;
                                }
                            }
                            if ($animal->getClassName() == 'Cat') {
                                if ($ageAtRegistration <= 1) {
                                    $result['ReturnedOwner']['Kitten'][] = $animal;
                                } else {
                                    $result['ReturnedOwner']['Cat'][] = $animal;
                                }
                            }
                            break;
                        case 'Adopted':
                            if ($animal->getClassName() == 'Dog') {
                                if ($ageAtRegistration <= 1) {
                                    $result['Adopted']['Puppy'][] = $animal;
                                } else {
                                    $result['Adopted']['Dog'][] = $animal;
                                }
                            }
                            if ($animal->getClassName() == 'Cat') {
                                if ($ageAtRegistration <= 1) {
                                    $result['Adopted']['Kitten'][] = $animal;
                                } else {
                                    $result['Adopted']['Cat'][] = $animal;
                                }
                            }
                            break;
                        case 'Lost':
                            if ($animal->getClassName() == 'Dog') {
                                if ($ageAtRegistration <= 1) {
                                    $result['Lost']['Puppy'][] = $animal;
                                } else {
                                    $result['Lost']['Dog'][] = $animal;
                                }
                            }
                            if ($animal->getClassName() == 'Cat') {
                                if ($ageAtRegistration <= 1) {
                                    $result['Lost']['Kitten'][] = $animal;
                                } else {
                                    $result['Lost']['Cat'][] = $animal;
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
            $this->filterResult = $result;
        }
    }
}