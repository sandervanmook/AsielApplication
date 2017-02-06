<?php


namespace Asiel\StatisticsBundle\Stats;


class AnimalStats
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

        // filter dan op gemeente en maak een sub array per gemeente

        $this->filterDate();
        $this->filterVia();
        $this->filterMunicipality();
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
                $states = $animal->getStatus();
                foreach ($states as $status) {
                    $statusDate = $status->getDate()->getTimestamp();
                    if (($statusDate >= $dateStart) && ($statusDate <= $dateEnd)) {
                        $result[] = $animal;
                    }
                }
                $this->filterResult = $result;
            }
        }
    }

    /**
     * use filterResult
     */
    private function filterVia()
    {
        $result = [];
        $via = $this->searchArray['via'];

        switch ($via) {
            case 'Both':
                if (!empty($this->filterResult)) {
                    foreach ($this->filterResult as $animal) {
                        $states = $animal->getStatus();
                        foreach ($states as $status) {
                            if (($status->getClassName() == 'Abandoned') ||
                                ($status->getClassName() == 'Found' && $status->getFoundType() == 'Door ons gevangen')
                            ) {
                                $result[] = $animal;
                            }
                        }
                    }
                    $this->filterResult = $result;
                }
                break;
            case 'Found_Catched':
                if (!empty($this->filterResult)) {
                    foreach ($this->filterResult as $animal) {
                        $states = $animal->getStatus();
                        foreach ($states as $status) {
                            if (($status->getClassName() == 'Found') && ($status->getFoundType() == 'Door ons gevangen')
                            ) {
                                $result[] = $animal;
                            }
                        }
                    }
                    $this->filterResult = $result;
                }
                break;
            case 'Abandoned':
                if (!empty($this->filterResult)) {
                    foreach ($this->filterResult as $animal) {
                        $states = $animal->getStatus();
                        foreach ($states as $status) {
                            if (($status->getClassName() == 'Abandoned')
                            ) {
                                $result[] = $animal;
                            }
                        }
                    }
                    $this->filterResult = $result;
                }
                break;
            default:
                throw new \InvalidArgumentException('No via selection has been made');
        }
    }

    /**
     * Last filter, splits the results into sub arrays based on the municipality and animal type
     */
    private function filterMunicipality()
    {
        $result = [];
        $municipalityArray = $this->searchArray['municipality'];

        if (!empty($this->filterResult)) {
            foreach ($this->filterResult as $animal) {
                // Municipality via found status.
                $states = $animal->getStatus();
                foreach ($states as $status) {
                    if (($status->getClassName() == 'Found') &&
                        (in_array($status->getFoundMunicipality(), $municipalityArray))
                    ) {
                        if ($animal->getClassName() == 'Cat') {
                            $result[$status->getFoundMunicipality()]['Cat'][] = $animal;
                        } elseif ($animal->getClassName() == 'Dog') {
                            $result[$status->getFoundMunicipality()]['Dog'][] = $animal;
                        }
                    }
                }
                // Municipality via customer municipality.
                foreach ($states as $status) {
                    if (($status->getClassName() == 'Abandoned') &&
                        (in_array($status->getAbandonedBy()->getMunicipality(), $municipalityArray))
                    ) {
                        // Make sure if the animal is already counted in other loop it isn't counted again.
                        if (!in_array($animal, $result)) {
                            if ($animal->getClassName() == 'Cat') {
                                $result[$status->getAbandonedBy()->getMunicipality()]['Cat'][] = $animal;
                            } elseif ($animal->getClassName() == 'Dog') {
                                $result[$status->getAbandonedBy()->getMunicipality()]['Dog'][] = $animal;
                            }
                        } else {
                            continue;
                        }
                    }
                }
            }
            $this->filterResult = $result;
        }
    }
}