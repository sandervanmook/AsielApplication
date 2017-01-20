<?php

namespace Asiel\CalendarBundle\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends EntityRepository
{
    /**
     * Not used anymore just for reference
     * @param $year
     * @param $month
     * @return array
     */
//    public function calendar($year, $month)
//    {
//        $emConfig = $this->getEntityManager()->getConfiguration();
//        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
//        $emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
//        $emConfig->addCustomDatetimeFunction('DAY', 'DoctrineExtensions\Query\Mysql\Day');
//
//        $qb = $this->createQueryBuilder('t');
//        $qb->where('YEAR(t.dateDue) = :year');
//        $qb->andWhere('MONTH(t.dateDue) = :month');
//        $qb->setParameter('month', $month);
//        $qb->setParameter('year', $year);
//
//        return $qb->getQuery()->getResult();
//    }

    /**
     * Used by Full Calendar
     * @param string $end
     * @param string $start
     * @return array
     */
    public function calendarData($end, $start)
    {
        $end = new DateTime($end);
        $start = new DateTime($start);

        $qb = $this->createQueryBuilder('t');
        $qb->leftJoin('t.animal', 'a');
        $qb->select(
            't.id, 
            t.title, 
            t.start, 
            t.description, 
            t.isComplete,
            t.createdBy,
            a.id AS animalid, 
            a.name AS animalname');
        $qb->where('t.dateDue BETWEEN :start AND :end');
        $qb->setParameter('start', $start->format('Y-m-d'));
        $qb->setParameter('end', $end->format('Y-m-d'));

        return $qb->getQuery()->getResult();
    }
}