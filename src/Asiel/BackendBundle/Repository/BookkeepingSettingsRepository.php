<?php

namespace Asiel\BackendBundle\Repository;

use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Doctrine\ORM\EntityRepository;


class BookkeepingSettingsRepository extends EntityRepository
{
    /**
     * Get current settings, always use id 1.
     * @return null|BookkeepingSettings
     */
    public function getSettings() : BookkeepingSettings
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.id = 1' );

        return $qb->getQuery()->getOneOrNullResult();
    }
}
