<?php


namespace Asiel\BookkeepingBundle\Filter;


class ActionFilter
{
    private $allActions;
    private $searchArray;
    private $filterResult;

    public function __construct($allActions, $searchArray)
    {
        $this->allActions = $allActions;
        $this->searchArray = $searchArray;
    }

    public function getFilterResult()
    {
        return $this->filterResult;
    }

    public function filter()
    {
        $this->filterDate();
        $this->filterType();
        $this->filterCompleted();
        $this->filterFullyPaid();
    }

    /**
     * First filter, use allActions
     */
    private function filterDate()
    {
        $result = [];
        $dateStart = $this->searchArray['datestart']->getTimestamp();
        $dateEnd = $this->searchArray['dateend']->getTimestamp();

        if (!empty($this->allActions)) {
            foreach ($this->allActions as $action) {
                $registerDate = $action->getDate()->getTimestamp();
                if (($registerDate >= $dateStart) &&
                    ($registerDate <= $dateEnd)
                ) {
                    $result[] = $action;
                }
            }
            $this->filterResult = $result;
        }
    }

    /**
     * Subfilters, use filterResult
     */

    private function filterType()
    {
        $result = [];
        $type = $this->searchArray['type'];

        // If all is selected, don't filter at all
        if (in_array('All', $type)) {
            return;
        }

        if (!empty($this->filterResult)) {
            foreach ($this->filterResult as $action) {
                if (in_array($action->getType(), $type)) {
                    $result[] = $action;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterCompleted()
    {
        $result = [];
        $completed = (bool)$this->searchArray['completed'];

        if (!empty($this->filterResult)) {
            foreach ($this->filterResult as $action) {
                if (($completed && $action->isCompleted()) ||
                    (!$completed && !$action->isCompleted())) {
                    $result[] = $action;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterFullyPaid()
    {
        $result = [];
        $fullyPaid = (bool)$this->searchArray['fullypaid'];

        if (!empty($this->filterResult)) {
            foreach ($this->filterResult as $action) {
                if (($fullyPaid && $action->getFullyPaid()) ||
                    (!$fullyPaid && !$action->getFullyPaid())) {
                    $result[] = $action;
                }
            }
            $this->filterResult = $result;
        }
    }

}