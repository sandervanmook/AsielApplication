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
        $this->filterStatus();
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

    private function filterStatus()
    {
        $result = [];
        $type = $this->searchArray['status'];

        if (!empty($this->filterResult)) {
            foreach ($this->filterResult as $action) {
                if ($type == 'Completed') {
                    if ($action->isCompleted()) {
                        $result[] = $action;
                    }
                    continue;
                }
                if ($type == 'Fullypaid') {
                    if ($action->isFullyPaid()) {
                        $result[] = $action;
                    }
                    continue;
                }
                if ($type == 'Sumremaining') {
                    if (!$action->isFullyPaid()) {
                        $result[] = $action;
                    }
                    continue;
                }
            }
            $this->filterResult = $result;
        }
    }
}