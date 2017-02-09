<?php

namespace Asiel\BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;


class BookkeepingSettingsRepository extends EntityRepository
{
    /**
     * Get current settings, always use id 1.
     * @return array
     */
    public function getSettings()
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.id = 1' );

        return $qb->getQuery()->getOneOrNullResult();
    }
}
