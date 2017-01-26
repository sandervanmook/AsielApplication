<?php


namespace Asiel\FrontendBundle\SearchAnimal;


class FilterAnimal
{
    private $allAnimals;
    private $searchArray;
    private $filterResult;

    public function __construct($allAnimals, $searchArray)
    {
        $this->allAnimals = $allAnimals;
        $this->searchArray = $searchArray;
        $this->filterType();
        $this->filterGender();
        $this->filterAge();
    }

    public function getFilterResult()
    {
        return $this->filterResult;
    }


    /**
     * First filter, use allAnimals
     */
    private function filterType()
    {
        $result = [];
        if ((!empty($this->searchArray['type'])) && (!empty($this->allAnimals))) {
            foreach ($this->allAnimals as $animal) {
                if (in_array($animal->getClassName(), $this->searchArray['type'])) {
                    $result[] = $animal;
                }
                $this->filterResult = $result;
            }
        }
    }

    /**
     * Use filterResult
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

    /**
     * Use filterResult
     */
    private function filterAge()
    {
        $result = [];
        if ((!empty($this->searchArray['agestart'])) &&
            (!empty($this->searchArray['ageend'])) &&
            (!empty($this->filterResult))
        )
        {
            $ageRange = range($this->searchArray['agestart'], $this->searchArray['ageend']);
            foreach ($this->filterResult as $animal) {
                if (in_array($animal->getAge(), $ageRange)) {
                    $result[] = $animal;
                }
                $this->filterResult = $result;
            }
        }
    }



}