<?php

namespace Asiel\AnimalBundle\Repository;

use AsielBundle\Model\ValueType\StatusValueType;
use Doctrine\ORM\EntityRepository;

class DogRepository extends EntityRepository
{
    /**
     * Age Category:
     * 0 = Puppy
     * 1 = Dog
     * 2 = Both
     *
     * @param $ageCategory
     * @return array
     * @throws \Exception
     */
    public function findAllOnsite($ageCategory)
    {
        $ageCategoryOptions = [0,1,2];
        if (!in_array($ageCategory, $ageCategoryOptions)) {
            throw new \Exception('Unknown age category');
        }

        $qb = $this->createQueryBuilder('d');
        $qb->leftJoin('d.status', 's');
        $qb->where('s.onsiteLocation = true');
        $qb->andWhere('s.archived = false');
        $qb->andWhere('d.visiblePublic = true');

        $result = $qb->getQuery()->getResult();

        switch ($ageCategory) {
            case 0:
                $puppies = [];
                foreach ($result as $animal) {
                    if ($animal->getAge() === 0) {
                        $puppies[] = $animal;
                    }
                }
                return $puppies;
                break;
            case 1:
                $dogs = [];
                foreach ($result as $animal) {
                    if ($animal->getAge() > 0) {
                        $dogs[] = $animal;
                    }
                }
                return $dogs;
                break;
            case 2:
                return $result;
                break;
        }
    }
}
