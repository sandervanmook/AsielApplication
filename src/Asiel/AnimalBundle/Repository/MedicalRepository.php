<?php

namespace Asiel\AnimalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MedicalRepository extends EntityRepository
{
    public function delete($id)
    {
        $qb = $this->createQueryBuilder('m');
        $qb->delete()
            ->where('m.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }
}
