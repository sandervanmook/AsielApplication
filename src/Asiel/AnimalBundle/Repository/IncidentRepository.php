<?php

namespace Asiel\AnimalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class IncidentRepository extends EntityRepository
{
    /**
     * @param $id integer
     * @return boolean
     */
    public function delete($id)
    {
        $qb = $this->createQueryBuilder('i');
        $qb->delete()
        ->where('i.id = :id')
        ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }
}
