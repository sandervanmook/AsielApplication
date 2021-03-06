<?php


namespace Asiel\Shared\Filter\Animal;


class AnimalFilter
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
        $this->filterType();
        $this->filterChipnumber();
        $this->filterGender();
        $this->filterAge();
        $this->filterStatus();
        $this->filterSterilized();
    }

    /**
     * Filters, use allAnimals
     */
    private function filterType()
    {
        $result = [];
        if ((!empty($this->searchArray['type'])) && (!empty($this->allAnimals))) {
            foreach ($this->allAnimals as $animal) {
                if (in_array($animal->getClassName(), $this->searchArray['type'])) {
                    $result[] = $animal;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterChipnumber()
    {
        $result = [];
        if ((!empty($this->searchArray['chipnumber'])) && (!empty($this->allAnimals))) {
            foreach ($this->allAnimals as $animal) {
                if ($animal->getChipnumber() == $this->searchArray['chipnumber']) {
                    $result[] = $animal;
                }
            }
            $this->filterResult = $result;
        }
    }


    /**
     * Sub filters, use filteredResult
     */

    private function filterGender()
    {
        $result = [];
        if ((!empty($this->searchArray['gender'])) && (!empty($this->filterResult))) {
            foreach ($this->filterResult as $animal) {
                if (in_array($animal->getGender(), $this->searchArray['gender'])) {
                    $result[] = $animal;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterAge()
    {
        $result = [];
        if ((!empty($this->searchArray['agestart'])) &&
            (!empty($this->searchArray['ageend'])) &&
            (!empty($this->filterResult))
        ) {
            $ageRange = range($this->searchArray['agestart'], $this->searchArray['ageend']);
            foreach ($this->filterResult as $animal) {
                if (in_array($animal->getAge(), $ageRange)) {
                    $result[] = $animal;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterStatus()
    {
        $result = [];
        if ((!empty($this->searchArray['status'])) && (!empty($this->filterResult))) {
            foreach ($this->filterResult as $animal) {
                // No status exception
                if ((in_array('None', $this->searchArray['status'])) && $animal->getStatus()->isEmpty()) {
                    $result[] = $animal;
                    // Normal case
                } elseif (in_array($animal->getActiveState(), $this->searchArray['status'])) {
                    $result[] = $animal;
                }
                $this->filterResult = $result;
            }
        }
    }

    /**
     * Use filterResult
     * We are getting the result from the Ajax request as strings, don't check on boolean value.
     */
    private function filterSterilized()
    {
        $result = [];
        if ((isset($this->searchArray['sterilized'])) &&
            ($this->searchArray['sterilized'] == 'true') &&
            (!empty($this->filterResult))
        ) {
            foreach ($this->filterResult as $animal) {
                if ($animal->getSterilized()) {
                    $result[] = $animal;
                }
            }

            $this->filterResult = $result;
        }

        if ((isset($this->searchArray['sterilized'])) &&
            ($this->searchArray['sterilized'] == 'false') &&
            (!empty($this->filterResult))
        ) {
            foreach ($this->filterResult as $animal) {
                if (!$animal->getSterilized()) {
                    $result[] = $animal;
                }
            }

            $this->filterResult = $result;
        }
    }

}