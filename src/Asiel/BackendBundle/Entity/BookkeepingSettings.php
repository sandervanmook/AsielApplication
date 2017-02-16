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
     * @ORM\Column(name="dog_unaffiliated_younger_than_one", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedYoungerThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_older_than_one", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedOlderThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_puppy", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedPuppy;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_not_chipped", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_not_vaccinated", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_fur_treatment_small_dog", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_fur_treatment_large_dog", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_ill", type="integer")
     */
    private $priceAbandonedDogUnaffiliatedAdditionIll;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_younger_than_one", type="integer")
     */
    private $priceAbandonedDogAffiliatedYoungerThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_older_than_one", type="integer")
     */
    private $priceAbandonedDogAffiliatedOlderThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_puppy", type="integer")
     */
    private $priceAbandonedDogAffiliatedPuppy;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_not_chipped", type="integer")
     */
    private $priceAbandonedDogAffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_not_vaccinated", type="integer")
     */
    private $priceAbandonedDogAffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_fur_treatment_small_dog", type="integer")
     */
    private $priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_fur_treatment_large_dog", type="integer")
     */
    private $priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_ill", type="integer")
     */
    private $priceAbandonedDogAffiliatedAdditionIll;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_younger_than_three_months", type="integer")
     */
    private $priceAbandonedCatUnaffiliatedYoungerThanThreeMonths;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_between_three_months_and_ten_years", type="integer")
     */
    private $priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_older_than_ten_years", type="integer")
     */
    private $priceAbandonedCatUnaffiliatedOlderThanTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_kitten", type="integer")
     */
    private $priceAbandonedCatUnaffiliatedKitten;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_addition_not_chipped", type="integer")
     */
    private $priceAbandonedCatUnaffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_addition_not_vaccinated", type="integer")
     */
    private $priceAbandonedCatUnaffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_addition_needs_sterilization", type="integer")
     */
    private $priceAbandonedCatUnaffiliatedAdditionNeedsSterilization ;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_younger_than_three_months", type="integer")
     */
    private $priceAbandonedCatAffiliatedYoungerThanThreeMonths;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_between_three_months_and_ten_years", type="integer")
     */
    private $priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_older_than_ten_years", type="integer")
     */
    private $priceAbandonedCatAffiliatedOlderThanTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_kitten", type="integer")
     */
    private $priceAbandonedCatAffiliatedKitten;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_addition_not_chipped", type="integer")
     */
    private $priceAbandonedCatAffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_addition_not_vaccinated", type="integer")
     */
    private $priceAbandonedCatAffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_addition_needs_sterilization", type="integer")
     */
    private $priceAbandonedCatAffiliatedAdditionNeedsSterilization ;


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
     * Set priceAbandonedDogUnaffiliatedYoungerThanOne
     *
     * @param integer $priceAbandonedDogUnaffiliatedYoungerThanOne
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedYoungerThanOne($priceAbandonedDogUnaffiliatedYoungerThanOne)
    {
        $this->priceAbandonedDogUnaffiliatedYoungerThanOne = $priceAbandonedDogUnaffiliatedYoungerThanOne;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedYoungerThanOne
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedYoungerThanOne()
    {
        return $this->priceAbandonedDogUnaffiliatedYoungerThanOne;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedOlderThanOne
     *
     * @param integer $priceAbandonedDogUnaffiliatedOlderThanOne
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedOlderThanOne($priceAbandonedDogUnaffiliatedOlderThanOne)
    {
        $this->priceAbandonedDogUnaffiliatedOlderThanOne = $priceAbandonedDogUnaffiliatedOlderThanOne;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedOlderThanOne
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedOlderThanOne()
    {
        return $this->priceAbandonedDogUnaffiliatedOlderThanOne;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedPuppy
     *
     * @param integer $priceAbandonedDogUnaffiliatedPuppy
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedPuppy($priceAbandonedDogUnaffiliatedPuppy)
    {
        $this->priceAbandonedDogUnaffiliatedPuppy = $priceAbandonedDogUnaffiliatedPuppy;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedPuppy
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedPuppy()
    {
        return $this->priceAbandonedDogUnaffiliatedPuppy;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionNotChipped
     *
     * @param integer $priceAbandonedDogUnaffiliatedAdditionNotChipped
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedAdditionNotChipped($priceAbandonedDogUnaffiliatedAdditionNotChipped)
    {
        $this->priceAbandonedDogUnaffiliatedAdditionNotChipped = $priceAbandonedDogUnaffiliatedAdditionNotChipped;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedAdditionNotChipped
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionNotVaccinated
     *
     * @param integer $priceAbandonedDogUnaffiliatedAdditionNotVaccinated
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedAdditionNotVaccinated($priceAbandonedDogUnaffiliatedAdditionNotVaccinated)
    {
        $this->priceAbandonedDogUnaffiliatedAdditionNotVaccinated = $priceAbandonedDogUnaffiliatedAdditionNotVaccinated;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedAdditionNotVaccinated
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog
     *
     * @param integer $priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog($priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog)
    {
        $this->priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog = $priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog
     *
     * @param integer $priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog($priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog)
    {
        $this->priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog = $priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionIll
     *
     * @param integer $priceAbandonedDogUnaffiliatedAdditionIll
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogUnaffiliatedAdditionIll($priceAbandonedDogUnaffiliatedAdditionIll)
    {
        $this->priceAbandonedDogUnaffiliatedAdditionIll = $priceAbandonedDogUnaffiliatedAdditionIll;

        return $this;
    }

    /**
     * Get priceAbandonedDogUnaffiliatedAdditionIll
     *
     * @return integer
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionIll()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionIll;
    }

    /**
     * Set priceAbandonedDogAffiliatedYoungerThanOne
     *
     * @param integer $priceAbandonedDogAffiliatedYoungerThanOne
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedYoungerThanOne($priceAbandonedDogAffiliatedYoungerThanOne)
    {
        $this->priceAbandonedDogAffiliatedYoungerThanOne = $priceAbandonedDogAffiliatedYoungerThanOne;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedYoungerThanOne
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedYoungerThanOne()
    {
        return $this->priceAbandonedDogAffiliatedYoungerThanOne;
    }

    /**
     * Set priceAbandonedDogAffiliatedOlderThanOne
     *
     * @param integer $priceAbandonedDogAffiliatedOlderThanOne
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedOlderThanOne($priceAbandonedDogAffiliatedOlderThanOne)
    {
        $this->priceAbandonedDogAffiliatedOlderThanOne = $priceAbandonedDogAffiliatedOlderThanOne;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedOlderThanOne
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedOlderThanOne()
    {
        return $this->priceAbandonedDogAffiliatedOlderThanOne;
    }

    /**
     * Set priceAbandonedDogAffiliatedPuppy
     *
     * @param integer $priceAbandonedDogAffiliatedPuppy
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedPuppy($priceAbandonedDogAffiliatedPuppy)
    {
        $this->priceAbandonedDogAffiliatedPuppy = $priceAbandonedDogAffiliatedPuppy;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedPuppy
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedPuppy()
    {
        return $this->priceAbandonedDogAffiliatedPuppy;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionNotChipped
     *
     * @param integer $priceAbandonedDogAffiliatedAdditionNotChipped
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedAdditionNotChipped($priceAbandonedDogAffiliatedAdditionNotChipped)
    {
        $this->priceAbandonedDogAffiliatedAdditionNotChipped = $priceAbandonedDogAffiliatedAdditionNotChipped;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedAdditionNotChipped
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedDogAffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionNotVaccinated
     *
     * @param integer $priceAbandonedDogAffiliatedAdditionNotVaccinated
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedAdditionNotVaccinated($priceAbandonedDogAffiliatedAdditionNotVaccinated)
    {
        $this->priceAbandonedDogAffiliatedAdditionNotVaccinated = $priceAbandonedDogAffiliatedAdditionNotVaccinated;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedAdditionNotVaccinated
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedDogAffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog
     *
     * @param integer $priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog($priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog)
    {
        $this->priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog = $priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog()
    {
        return $this->priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog
     *
     * @param integer $priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog($priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog)
    {
        $this->priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog = $priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog()
    {
        return $this->priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionIll
     *
     * @param integer $priceAbandonedDogAffiliatedAdditionIll
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedDogAffiliatedAdditionIll($priceAbandonedDogAffiliatedAdditionIll)
    {
        $this->priceAbandonedDogAffiliatedAdditionIll = $priceAbandonedDogAffiliatedAdditionIll;

        return $this;
    }

    /**
     * Get priceAbandonedDogAffiliatedAdditionIll
     *
     * @return integer
     */
    public function getPriceAbandonedDogAffiliatedAdditionIll()
    {
        return $this->priceAbandonedDogAffiliatedAdditionIll;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedYoungerThanThreeMonths
     *
     * @param integer $priceAbandonedCatUnaffiliatedYoungerThanThreeMonths
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths($priceAbandonedCatUnaffiliatedYoungerThanThreeMonths)
    {
        $this->priceAbandonedCatUnaffiliatedYoungerThanThreeMonths = $priceAbandonedCatUnaffiliatedYoungerThanThreeMonths;

        return $this;
    }

    /**
     * Get priceAbandonedCatUnaffiliatedYoungerThanThreeMonths
     *
     * @return integer
     */
    public function getPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths()
    {
        return $this->priceAbandonedCatUnaffiliatedYoungerThanThreeMonths;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears
     *
     * @param integer $priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears($priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears)
    {
        $this->priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears = $priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears;

        return $this;
    }

    /**
     * Get priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears
     *
     * @return integer
     */
    public function getPriceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears()
    {
        return $this->priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedOlderThanTenYears
     *
     * @param integer $priceAbandonedCatUnaffiliatedOlderThanTenYears
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatUnaffiliatedOlderThanTenYears($priceAbandonedCatUnaffiliatedOlderThanTenYears)
    {
        $this->priceAbandonedCatUnaffiliatedOlderThanTenYears = $priceAbandonedCatUnaffiliatedOlderThanTenYears;

        return $this;
    }

    /**
     * Get priceAbandonedCatUnaffiliatedOlderThanTenYears
     *
     * @return integer
     */
    public function getPriceAbandonedCatUnaffiliatedOlderThanTenYears()
    {
        return $this->priceAbandonedCatUnaffiliatedOlderThanTenYears;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedKitten
     *
     * @param integer $priceAbandonedCatUnaffiliatedKitten
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatUnaffiliatedKitten($priceAbandonedCatUnaffiliatedKitten)
    {
        $this->priceAbandonedCatUnaffiliatedKitten = $priceAbandonedCatUnaffiliatedKitten;

        return $this;
    }

    /**
     * Get priceAbandonedCatUnaffiliatedKitten
     *
     * @return integer
     */
    public function getPriceAbandonedCatUnaffiliatedKitten()
    {
        return $this->priceAbandonedCatUnaffiliatedKitten;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedAdditionNotChipped
     *
     * @param integer $priceAbandonedCatUnaffiliatedAdditionNotChipped
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatUnaffiliatedAdditionNotChipped($priceAbandonedCatUnaffiliatedAdditionNotChipped)
    {
        $this->priceAbandonedCatUnaffiliatedAdditionNotChipped = $priceAbandonedCatUnaffiliatedAdditionNotChipped;

        return $this;
    }

    /**
     * Get priceAbandonedCatUnaffiliatedAdditionNotChipped
     *
     * @return integer
     */
    public function getPriceAbandonedCatUnaffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedCatUnaffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedAdditionNotVaccinated
     *
     * @param integer $priceAbandonedCatUnaffiliatedAdditionNotVaccinated
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatUnaffiliatedAdditionNotVaccinated($priceAbandonedCatUnaffiliatedAdditionNotVaccinated)
    {
        $this->priceAbandonedCatUnaffiliatedAdditionNotVaccinated = $priceAbandonedCatUnaffiliatedAdditionNotVaccinated;

        return $this;
    }

    /**
     * Get priceAbandonedCatUnaffiliatedAdditionNotVaccinated
     *
     * @return integer
     */
    public function getPriceAbandonedCatUnaffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedCatUnaffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedAdditionNeedsSterilization
     *
     * @param integer $priceAbandonedCatUnaffiliatedAdditionNeedsSterilization
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatUnaffiliatedAdditionNeedsSterilization($priceAbandonedCatUnaffiliatedAdditionNeedsSterilization)
    {
        $this->priceAbandonedCatUnaffiliatedAdditionNeedsSterilization = $priceAbandonedCatUnaffiliatedAdditionNeedsSterilization;

        return $this;
    }

    /**
     * Get priceAbandonedCatUnaffiliatedAdditionNeedsSterilization
     *
     * @return integer
     */
    public function getPriceAbandonedCatUnaffiliatedAdditionNeedsSterilization()
    {
        return $this->priceAbandonedCatUnaffiliatedAdditionNeedsSterilization;
    }

    /**
     * Set priceAbandonedCatAffiliatedYoungerThanThreeMonths
     *
     * @param integer $priceAbandonedCatAffiliatedYoungerThanThreeMonths
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatAffiliatedYoungerThanThreeMonths($priceAbandonedCatAffiliatedYoungerThanThreeMonths)
    {
        $this->priceAbandonedCatAffiliatedYoungerThanThreeMonths = $priceAbandonedCatAffiliatedYoungerThanThreeMonths;

        return $this;
    }

    /**
     * Get priceAbandonedCatAffiliatedYoungerThanThreeMonths
     *
     * @return integer
     */
    public function getPriceAbandonedCatAffiliatedYoungerThanThreeMonths()
    {
        return $this->priceAbandonedCatAffiliatedYoungerThanThreeMonths;
    }

    /**
     * Set priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears
     *
     * @param integer $priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears($priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears)
    {
        $this->priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears = $priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears;

        return $this;
    }

    /**
     * Get priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears
     *
     * @return integer
     */
    public function getPriceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears()
    {
        return $this->priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears;
    }

    /**
     * Set priceAbandonedCatAffiliatedOlderThanTenYears
     *
     * @param integer $priceAbandonedCatAffiliatedOlderThanTenYears
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatAffiliatedOlderThanTenYears($priceAbandonedCatAffiliatedOlderThanTenYears)
    {
        $this->priceAbandonedCatAffiliatedOlderThanTenYears = $priceAbandonedCatAffiliatedOlderThanTenYears;

        return $this;
    }

    /**
     * Get priceAbandonedCatAffiliatedOlderThanTenYears
     *
     * @return integer
     */
    public function getPriceAbandonedCatAffiliatedOlderThanTenYears()
    {
        return $this->priceAbandonedCatAffiliatedOlderThanTenYears;
    }

    /**
     * Set priceAbandonedCatAffiliatedKitten
     *
     * @param integer $priceAbandonedCatAffiliatedKitten
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatAffiliatedKitten($priceAbandonedCatAffiliatedKitten)
    {
        $this->priceAbandonedCatAffiliatedKitten = $priceAbandonedCatAffiliatedKitten;

        return $this;
    }

    /**
     * Get priceAbandonedCatAffiliatedKitten
     *
     * @return integer
     */
    public function getPriceAbandonedCatAffiliatedKitten()
    {
        return $this->priceAbandonedCatAffiliatedKitten;
    }

    /**
     * Set priceAbandonedCatAffiliatedAdditionNotChipped
     *
     * @param integer $priceAbandonedCatAffiliatedAdditionNotChipped
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatAffiliatedAdditionNotChipped($priceAbandonedCatAffiliatedAdditionNotChipped)
    {
        $this->priceAbandonedCatAffiliatedAdditionNotChipped = $priceAbandonedCatAffiliatedAdditionNotChipped;

        return $this;
    }

    /**
     * Get priceAbandonedCatAffiliatedAdditionNotChipped
     *
     * @return integer
     */
    public function getPriceAbandonedCatAffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedCatAffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedCatAffiliatedAdditionNotVaccinated
     *
     * @param integer $priceAbandonedCatAffiliatedAdditionNotVaccinated
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatAffiliatedAdditionNotVaccinated($priceAbandonedCatAffiliatedAdditionNotVaccinated)
    {
        $this->priceAbandonedCatAffiliatedAdditionNotVaccinated = $priceAbandonedCatAffiliatedAdditionNotVaccinated;

        return $this;
    }

    /**
     * Get priceAbandonedCatAffiliatedAdditionNotVaccinated
     *
     * @return integer
     */
    public function getPriceAbandonedCatAffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedCatAffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedCatAffiliatedAdditionNeedsSterilization
     *
     * @param integer $priceAbandonedCatAffiliatedAdditionNeedsSterilization
     *
     * @return BookkeepingSettings
     */
    public function setPriceAbandonedCatAffiliatedAdditionNeedsSterilization($priceAbandonedCatAffiliatedAdditionNeedsSterilization)
    {
        $this->priceAbandonedCatAffiliatedAdditionNeedsSterilization = $priceAbandonedCatAffiliatedAdditionNeedsSterilization;

        return $this;
    }

    /**
     * Get priceAbandonedCatAffiliatedAdditionNeedsSterilization
     *
     * @return integer
     */
    public function getPriceAbandonedCatAffiliatedAdditionNeedsSterilization()
    {
        return $this->priceAbandonedCatAffiliatedAdditionNeedsSterilization;
    }
}
