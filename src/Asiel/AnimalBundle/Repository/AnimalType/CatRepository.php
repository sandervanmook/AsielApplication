<?php

namespace Asiel\AnimalBundle\Repository;

use AsielBundle\Model\ValueType\StatusValueType;
use Doctrine\ORM\EntityRepository;

class CatRepository extends EntityRepository
{
    /**
     * Age Category:
     * 0 = Kitten
     * 1 = Cat
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

        $qb = $this->createQueryBuilder('c');
        $qb->leftJoin('c.status', 's');
        $qb->where('s.onsiteLocation = true');
        $qb->andWhere('s.archived = false');
        $qb->andWhere('c.visiblePublic = true');

        $result = $qb->getQuery()->getResult();

        switch ($ageCategory) {
            case 0:
                $kittens = [];
                foreach ($result as $animal) {
                    if ($animal->getAge() === 0) {
                        $kittens[] = $animal;
                    }
                }
                return $kittens;
                break;
            case 1:
                $cats = [];
                foreach ($result as $animal) {
                    if ($animal->getAge() > 0) {
                        $cats[] = $animal;
                    }
                }
                return $cats;
                break;
            case 2:
                return $result;
                break;
        }
    }

}
