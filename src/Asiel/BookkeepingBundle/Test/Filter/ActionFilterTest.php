<?php


namespace Asiel\BookkeepingBundle\Test\Filter;


use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\BookkeepingBundle\Filter\ActionFilter;

class ActionFilterTest extends \PHPUnit_Framework_TestCase
{
    public function test_date_filter()
    {
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Adopted');
        $action->setCompleted(true);
        $allActions = [$action];

        $searchArray['datestart'] = new \DateTime('yesterday');
        $searchArray['dateend'] = new \DateTime('now');
        $searchArray['type'] = ['Adopted'];
        $searchArray['status'] = 'Completed';

        $filter = new ActionFilter($allActions, $searchArray);
        $filter->filter();

        $result = $filter->getFilterResult();
        $expected = [$action];

        $this->assertEquals($expected, $result);
    }

    public function test_type_all_filter()
    {
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Adopted');
        $action->setCompleted(true);
        $allActions = [$action];

        $searchArray['datestart'] = new \DateTime('yesterday');
        $searchArray['dateend'] = new \DateTime('now');
        $searchArray['type'] = ['All'];
        $searchArray['status'] = 'Completed';

        $filter = new ActionFilter($allActions, $searchArray);
        $filter->filter();

        $result = $filter->getFilterResult();
        $expected = [$action];

        $this->assertEquals($expected, $result);
    }

    public function test_status_fullypaid_filter()
    {
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Adopted');
        $action->setFullyPaid(true);
        $allActions = [$action];

        $searchArray['datestart'] = new \DateTime('yesterday');
        $searchArray['dateend'] = new \DateTime('now');
        $searchArray['type'] = ['All'];
        $searchArray['status'] = 'Fullypaid';

        $filter = new ActionFilter($allActions, $searchArray);
        $filter->filter();

        $result = $filter->getFilterResult();
        $expected = [$action];

        $this->assertEquals($expected, $result);
    }

    public function test_status_sumremaining_filter()
    {
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Adopted');
        $action->setTotalCosts(100);
        $allActions = [$action];

        $searchArray['datestart'] = new \DateTime('yesterday');
        $searchArray['dateend'] = new \DateTime('now');
        $searchArray['type'] = ['All'];
        $searchArray['status'] = 'Sumremaining';

        $filter = new ActionFilter($allActions, $searchArray);
        $filter->filter();

        $result = $filter->getFilterResult();
        $expected = [$action];

        $this->assertEquals($expected, $result);
    }
}
