<?php

namespace Asiel\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookkeepingSettings
 *
 * @ORM\Table(name="backend_bookkeeping_settings")
 * @ORM\Entity(repositoryClass="Asiel\BackendBundle\Repository\BookkeepingSettingsRepository")
 */
class BookkeepingSettings
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="price_adopted_kitten", type="integer")
     */
    private $priceAdoptedKitten;

    /**
     * @var int
     *
     * @ORM\Column(name="price_adopted_cat", type="integer")
     */
    private $priceAdoptedCat;

    /**
     * @var int
     *
     * @ORM\Column(name="price_adopted_puppy", type="integer")
     */
    private $priceAdoptedPuppy;

    /**
     * @var int
     *
     * @ORM\Column(name="price_adopted_dog", type="integer")
     */
    private $priceAdoptedDog;

    /**
     * @var int
     *
     * @ORM\Column(name="price_abandoned_kitten", type="integer")
     */
    private $priceAbandonedKitten;

    /**
     * @var int
     *
     * @ORM\Column(name="price_abandoned_cat", type="integer")
     */
    private $priceAbandonedCat;

    /**
     * @var int
     *
     * @ORM\Column(name="price_abandoned_puppy", type="integer")
     */
    private $priceAbandonedPuppy;

    /**
     * @var int
     *
     * @ORM\Column(name="price_abandoned_dog", type="integer")
     */
    private $priceAbandonedDog;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set priceAdoptedKitten
     *
     * @param integer $priceAdoptedKitten
     *
     * @return BookkeepingSettings
     */
    public function setPriceAdoptedKitten($priceAdoptedKitten)
    {
        $this->priceAdoptedKitten = $priceAdoptedKitten;

        return $this;
    }

    /**
     * Get priceAdoptedKitten
     *
     * @return int
     */
    public function getPriceAdoptedKitten()
    {
        return $this->priceAdoptedKitten;
    }

    /**
     * Set priceAdoptedCat
     *
     * @param integer $priceAdoptedCat
     *
     * @return BookkeepingSettings
     */
    public function setPriceAdoptedCat($priceAdoptedCat)
    {
        $this->priceAdoptedCat = $priceAdoptedCat;

        return $this;
    }

    /**
     * Get priceAdoptedCat
     *
     * @return int
     */
    public function getPriceAdoptedCat()
    {
        return $this->priceAdoptedCat;
    }

    /**
     * Set priceAdoptedPuppy
     *
     * @param integer $priceAdoptedPuppy
     *
     * @return BookkeepingSettings
     */
    public function setPriceAdoptedPuppy($priceAdoptedPuppy)
    {
        $this->priceAdoptedPuppy = $priceAdoptedPuppy;

        return $this;
    }

    /**
     * Get priceAdoptedPuppy
     *
     * @return int
     */
    public function getPriceAdoptedPuppy()
    {
        return $this->priceAdoptedPuppy;
    }

    /**
     * Set priceAdoptedDog
     *
     * @param integer $priceAdoptedDog
     *
     * @return BookkeepingSettings
     */
    public function setPriceAdoptedDog($priceAdoptedDog)
    {
        $this->priceAdoptedDog = $priceAdoptedDog;

        return $this;
    }

    /**
     * Get priceAdoptedDog
     *
     * @return int
     */
    public function getPriceAdoptedDog()
    {
        return $this->priceAdoptedDog;
    }

    /**
     * Set priceAbandonedKitten
     *
     * @param integer $priceAbandonedKitten
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedKitten($priceAbandonedKitten)
    {
        $this->priceAbandonedKitten = $priceAbandonedKitten;

        return $this;
    }

    /**
     * Get priceAbandonedKitten
     *
     * @return int
     */
    public function getPriceAbandonedKitten()
    {
        return $this->priceAbandonedKitten;
    }

    /**
     * Set priceAbandonedCat
     *
     * @param integer $priceAbandonedCat
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCat($priceAbandonedCat)
    {
        $this->priceAbandonedCat = $priceAbandonedCat;

        return $this;
    }

    /**
     * Get priceAbandonedCat
     *
     * @return int
     */
    public function getPriceAbandonedCat()
    {
        return $this->priceAbandonedCat;
    }

    /**
     * Set priceAbandonedPuppy
     *
     * @param integer $priceAbandonedPuppy
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedPuppy($priceAbandonedPuppy)
    {
        $this->priceAbandonedPuppy = $priceAbandonedPuppy;

        return $this;
    }

    /**
     * Get priceAbandonedPuppy
     *
     * @return int
     */
    public function getPriceAbandonedPuppy()
    {
        return $this->priceAbandonedPuppy;
    }

    /**
     * Set priceAbandonedDog
     *
     * @param integer $priceAbandonedDog
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDog($priceAbandonedDog)
    {
        $this->priceAbandonedDog = $priceAbandonedDog;

        return $this;
    }

    /**
     * Get priceAbandonedDog
     *
     * @return int
     */
    public function getPriceAbandonedDog()
    {
        return $this->priceAbandonedDog;
    }
}

