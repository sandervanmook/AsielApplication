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
     * @ORM\Column(name="price_adopted_kitten", type="float")
     */
    private $priceAdoptedKitten;

    /**
     * @var int
     *
     * @ORM\Column(name="price_adopted_cat", type="float")
     */
    private $priceAdoptedCat;

    /**
     * @var int
     *
     * @ORM\Column(name="price_adopted_puppy", type="float")
     */
    private $priceAdoptedPuppy;

    /**
     * @var int
     *
     * @ORM\Column(name="price_adopted_dog", type="float")
     */
    private $priceAdoptedDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_younger_than_one", type="float")
     */
    private $priceAbandonedDogUnaffiliatedYoungerThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_older_than_one", type="float")
     */
    private $priceAbandonedDogUnaffiliatedOlderThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_puppy", type="float")
     */
    private $priceAbandonedDogUnaffiliatedPuppy;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_not_chipped", type="float")
     */
    private $priceAbandonedDogUnaffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_not_vaccinated", type="float")
     */
    private $priceAbandonedDogUnaffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_fur_treatment_small_dog", type="float")
     */
    private $priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_fur_treatment_large_dog", type="float")
     */
    private $priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_unaffiliated_addition_ill", type="float")
     */
    private $priceAbandonedDogUnaffiliatedAdditionIll;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_younger_than_one", type="float")
     */
    private $priceAbandonedDogAffiliatedYoungerThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_older_than_one", type="float")
     */
    private $priceAbandonedDogAffiliatedOlderThanOne;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_puppy", type="float")
     */
    private $priceAbandonedDogAffiliatedPuppy;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_not_chipped", type="float")
     */
    private $priceAbandonedDogAffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_not_vaccinated", type="float")
     */
    private $priceAbandonedDogAffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_fur_treatment_small_dog", type="float")
     */
    private $priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_fur_treatment_large_dog", type="float")
     */
    private $priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog;

    /**
     * @var int
     *
     * @ORM\Column(name="dog_affiliated_addition_ill", type="float")
     */
    private $priceAbandonedDogAffiliatedAdditionIll;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_younger_than_three_months", type="float")
     */
    private $priceAbandonedCatUnaffiliatedYoungerThanThreeMonths;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_between_three_months_and_ten_years", type="float")
     */
    private $priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_older_than_ten_years", type="float")
     */
    private $priceAbandonedCatUnaffiliatedOlderThanTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_kitten", type="float")
     */
    private $priceAbandonedCatUnaffiliatedKitten;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_addition_not_chipped", type="float")
     */
    private $priceAbandonedCatUnaffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_addition_not_vaccinated", type="float")
     */
    private $priceAbandonedCatUnaffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_unaffiliated_addition_needs_sterilization", type="float")
     */
    private $priceAbandonedCatUnaffiliatedAdditionNeedsSterilization ;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_younger_than_three_months", type="float")
     */
    private $priceAbandonedCatAffiliatedYoungerThanThreeMonths;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_between_three_months_and_ten_years", type="float")
     */
    private $priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_older_than_ten_years", type="float")
     */
    private $priceAbandonedCatAffiliatedOlderThanTenYears;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_kitten", type="float")
     */
    private $priceAbandonedCatAffiliatedKitten;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_addition_not_chipped", type="float")
     */
    private $priceAbandonedCatAffiliatedAdditionNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_addition_not_vaccinated", type="float")
     */
    private $priceAbandonedCatAffiliatedAdditionNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_affiliated_addition_needs_sterilization", type="float")
     */
    private $priceAbandonedCatAffiliatedAdditionNeedsSterilization;

    /**
     * @var int
     *
     * @ORM\Column(name="price_found_fee", type="float")
     */
    private $priceFoundFee;

    /**
     * @var int
     *
     * @ORM\Column(name="price_found_not_chipped", type="float")
     */
    private $priceFoundNotChipped;

    /**
     * @var int
     *
     * @ORM\Column(name="price_found_not_vaccinated", type="float")
     */
    private $priceFoundNotVaccinated;

    /**
     * @var int
     *
     * @ORM\Column(name="price_found_de_worm", type="float")
     */
    private $priceFoundDeWorm;

    /**
     * @var int
     *
     * @ORM\Column(name="price_found_tenancy_per_day", type="float")
     */
    private $priceFoundTenancyPerDay;


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
     * @param float $priceAdoptedKitten
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
     * @param float $priceAdoptedCat
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
     * @param float $priceAdoptedPuppy
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
     * @param float $priceAdoptedDog
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
     * @param float $priceAbandonedDogUnaffiliatedYoungerThanOne
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedYoungerThanOne()
    {
        return $this->priceAbandonedDogUnaffiliatedYoungerThanOne;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedOlderThanOne
     *
     * @param float $priceAbandonedDogUnaffiliatedOlderThanOne
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedOlderThanOne()
    {
        return $this->priceAbandonedDogUnaffiliatedOlderThanOne;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedPuppy
     *
     * @param float $priceAbandonedDogUnaffiliatedPuppy
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedPuppy()
    {
        return $this->priceAbandonedDogUnaffiliatedPuppy;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionNotChipped
     *
     * @param float $priceAbandonedDogUnaffiliatedAdditionNotChipped
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionNotVaccinated
     *
     * @param float $priceAbandonedDogUnaffiliatedAdditionNotVaccinated
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog
     *
     * @param float $priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog
     *
     * @param float $priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog;
    }

    /**
     * Set priceAbandonedDogUnaffiliatedAdditionIll
     *
     * @param float $priceAbandonedDogUnaffiliatedAdditionIll
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
     * @return float
     */
    public function getPriceAbandonedDogUnaffiliatedAdditionIll()
    {
        return $this->priceAbandonedDogUnaffiliatedAdditionIll;
    }

    /**
     * Set priceAbandonedDogAffiliatedYoungerThanOne
     *
     * @param float $priceAbandonedDogAffiliatedYoungerThanOne
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedYoungerThanOne()
    {
        return $this->priceAbandonedDogAffiliatedYoungerThanOne;
    }

    /**
     * Set priceAbandonedDogAffiliatedOlderThanOne
     *
     * @param float $priceAbandonedDogAffiliatedOlderThanOne
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedOlderThanOne()
    {
        return $this->priceAbandonedDogAffiliatedOlderThanOne;
    }

    /**
     * Set priceAbandonedDogAffiliatedPuppy
     *
     * @param float $priceAbandonedDogAffiliatedPuppy
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedPuppy()
    {
        return $this->priceAbandonedDogAffiliatedPuppy;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionNotChipped
     *
     * @param float $priceAbandonedDogAffiliatedAdditionNotChipped
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedDogAffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionNotVaccinated
     *
     * @param float $priceAbandonedDogAffiliatedAdditionNotVaccinated
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedDogAffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog
     *
     * @param float $priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog()
    {
        return $this->priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog
     *
     * @param float $priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog()
    {
        return $this->priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog;
    }

    /**
     * Set priceAbandonedDogAffiliatedAdditionIll
     *
     * @param float $priceAbandonedDogAffiliatedAdditionIll
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
     * @return float
     */
    public function getPriceAbandonedDogAffiliatedAdditionIll()
    {
        return $this->priceAbandonedDogAffiliatedAdditionIll;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedYoungerThanThreeMonths
     *
     * @param float $priceAbandonedCatUnaffiliatedYoungerThanThreeMonths
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
     * @return float
     */
    public function getPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths()
    {
        return $this->priceAbandonedCatUnaffiliatedYoungerThanThreeMonths;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears
     *
     * @param float $priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears
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
     * @return float
     */
    public function getPriceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears()
    {
        return $this->priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedOlderThanTenYears
     *
     * @param float $priceAbandonedCatUnaffiliatedOlderThanTenYears
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
     * @return float
     */
    public function getPriceAbandonedCatUnaffiliatedOlderThanTenYears()
    {
        return $this->priceAbandonedCatUnaffiliatedOlderThanTenYears;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedKitten
     *
     * @param float $priceAbandonedCatUnaffiliatedKitten
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
     * @return float
     */
    public function getPriceAbandonedCatUnaffiliatedKitten()
    {
        return $this->priceAbandonedCatUnaffiliatedKitten;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedAdditionNotChipped
     *
     * @param float $priceAbandonedCatUnaffiliatedAdditionNotChipped
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
     * @return float
     */
    public function getPriceAbandonedCatUnaffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedCatUnaffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedAdditionNotVaccinated
     *
     * @param float $priceAbandonedCatUnaffiliatedAdditionNotVaccinated
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
     * @return float
     */
    public function getPriceAbandonedCatUnaffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedCatUnaffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedCatUnaffiliatedAdditionNeedsSterilization
     *
     * @param float $priceAbandonedCatUnaffiliatedAdditionNeedsSterilization
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
     * @return float
     */
    public function getPriceAbandonedCatUnaffiliatedAdditionNeedsSterilization()
    {
        return $this->priceAbandonedCatUnaffiliatedAdditionNeedsSterilization;
    }

    /**
     * Set priceAbandonedCatAffiliatedYoungerThanThreeMonths
     *
     * @param float $priceAbandonedCatAffiliatedYoungerThanThreeMonths
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
     * @return float
     */
    public function getPriceAbandonedCatAffiliatedYoungerThanThreeMonths()
    {
        return $this->priceAbandonedCatAffiliatedYoungerThanThreeMonths;
    }

    /**
     * Set priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears
     *
     * @param float $priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears
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
     * @return float
     */
    public function getPriceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears()
    {
        return $this->priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears;
    }

    /**
     * Set priceAbandonedCatAffiliatedOlderThanTenYears
     *
     * @param float $priceAbandonedCatAffiliatedOlderThanTenYears
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
     * @return float
     */
    public function getPriceAbandonedCatAffiliatedOlderThanTenYears()
    {
        return $this->priceAbandonedCatAffiliatedOlderThanTenYears;
    }

    /**
     * Set priceAbandonedCatAffiliatedKitten
     *
     * @param float $priceAbandonedCatAffiliatedKitten
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
     * @return float
     */
    public function getPriceAbandonedCatAffiliatedKitten()
    {
        return $this->priceAbandonedCatAffiliatedKitten;
    }

    /**
     * Set priceAbandonedCatAffiliatedAdditionNotChipped
     *
     * @param float $priceAbandonedCatAffiliatedAdditionNotChipped
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
     * @return float
     */
    public function getPriceAbandonedCatAffiliatedAdditionNotChipped()
    {
        return $this->priceAbandonedCatAffiliatedAdditionNotChipped;
    }

    /**
     * Set priceAbandonedCatAffiliatedAdditionNotVaccinated
     *
     * @param float $priceAbandonedCatAffiliatedAdditionNotVaccinated
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
     * @return float
     */
    public function getPriceAbandonedCatAffiliatedAdditionNotVaccinated()
    {
        return $this->priceAbandonedCatAffiliatedAdditionNotVaccinated;
    }

    /**
     * Set priceAbandonedCatAffiliatedAdditionNeedsSterilization
     *
     * @param float $priceAbandonedCatAffiliatedAdditionNeedsSterilization
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
     * @return float
     */
    public function getPriceAbandonedCatAffiliatedAdditionNeedsSterilization()
    {
        return $this->priceAbandonedCatAffiliatedAdditionNeedsSterilization;
    }

    /**
     * Set priceFoundFee
     *
     * @param float $priceFoundFee
     *
     * @return BookkeepingSettings
     */
    public function setPriceFoundFee($priceFoundFee)
    {
        $this->priceFoundFee = $priceFoundFee;

        return $this;
    }

    /**
     * Get priceFoundFee
     *
     * @return float
     */
    public function getPriceFoundFee()
    {
        return $this->priceFoundFee;
    }

    /**
     * Set priceFoundNotChipped
     *
     * @param float $priceFoundNotChipped
     *
     * @return BookkeepingSettings
     */
    public function setPriceFoundNotChipped($priceFoundNotChipped)
    {
        $this->priceFoundNotChipped = $priceFoundNotChipped;

        return $this;
    }

    /**
     * Get priceFoundNotChipped
     *
     * @return float
     */
    public function getPriceFoundNotChipped()
    {
        return $this->priceFoundNotChipped;
    }

    /**
     * Set priceFoundNotVaccinated
     *
     * @param float $priceFoundNotVaccinated
     *
     * @return BookkeepingSettings
     */
    public function setPriceFoundNotVaccinated($priceFoundNotVaccinated)
    {
        $this->priceFoundNotVaccinated = $priceFoundNotVaccinated;

        return $this;
    }

    /**
     * Get priceFoundNotVaccinated
     *
     * @return float
     */
    public function getPriceFoundNotVaccinated()
    {
        return $this->priceFoundNotVaccinated;
    }

    /**
     * Set priceFoundDeWorm
     *
     * @param float $priceFoundDeWorm
     *
     * @return BookkeepingSettings
     */
    public function setPriceFoundDeWorm($priceFoundDeWorm)
    {
        $this->priceFoundDeWorm = $priceFoundDeWorm;

        return $this;
    }

    /**
     * Get priceFoundDeWorm
     *
     * @return float
     */
    public function getPriceFoundDeWorm()
    {
        return $this->priceFoundDeWorm;
    }

    /**
     * Set priceFoundTenancyPerDay
     *
     * @param float $priceFoundTenancyPerDay
     *
     * @return BookkeepingSettings
     */
    public function setPriceFoundTenancyPerDay($priceFoundTenancyPerDay)
    {
        $this->priceFoundTenancyPerDay = $priceFoundTenancyPerDay;

        return $this;
    }

    /**
     * Get priceFoundTenancyPerDay
     *
     * @return float
     */
    public function getPriceFoundTenancyPerDay()
    {
        return $this->priceFoundTenancyPerDay;
    }
}
