<?php

namespace Asiel\AnimalBundle\Repository;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;

/**
 * StatusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatusRepository extends EntityRepository
{
    /**
     * Set all status of this animal to archived.
     * To be used when creating a new status.
     * New status will be the active one (only one not archived)
     * @param Collection $states
     * @return null
     */
    public function setStatesArchived($states)
    {
        $em = $this->getEntityManager();

        if (is_null($states)) {
            return null;
        }

        foreach ($states as $state) {
            $state->setArchived(true);
            $em->flush();
        }
    }

    /**
     * @param $id integer
     * @return boolean
     * TODO Not used anymore ?
     */
    public function delete($id)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->delete()
            ->where('s.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }
}
