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
                $registerDate = $animal->getRegisterDate();
                $dayOfBirth = $animal->getDayOfBirth();

                $interval = $registerDate->diff($dayOfBirth);
                $ageAtRegistration = $interval->y;

                $registerDate = $animal->getRegisterDate()->getTimestamp();
                if (($registerDate >= $dateStart) &&
                    ($registerDate <= $dateEnd) &&
                    ($ageAtRegistration <= 1)
                ) {
                    $result ++;
                }
            }
            $this->filterResult = $result;
        }
    }
}