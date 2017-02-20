<?php


namespace Asiel\StatisticsBundle\Stats;


class AnimalKittenStats
{
    private $allCats;
    private $searchArray;
    private $filterResult;

    public function __construct($allCats, $searchArray)
    {
        $this->allCats = $allCats;
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
        $result = 0;
        $dateStart = $this->searchArray['datestart']->getTimestamp();
        $dateEnd = $this->searchArray['dateend']->getTimestamp();

        if (!empty($this->allCats)) {
            foreach ($this->allCats as $animal) {
                $admissionDate = $animal->getAdmissionDate();
                $dayOfBirth = $animal->getDayOfBirth();

                $interval = $admissionDate->diff($dayOfBirth);
                $ageAtRegistration = $interval->y;

                $admissionDate = $animal->getAdmissionDate()->getTimestamp();
                if (($admissionDate >= $dateStart) &&
                    ($admissionDate <= $dateEnd) &&
                    ($ageAtRegistration <= 1)
                ) {
                    $result ++;
                }
            }
            $this->filterResult = $result;
        }
    }
}