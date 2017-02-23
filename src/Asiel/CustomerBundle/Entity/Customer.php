<?php

namespace Asiel\CustomerBundle\Entity;

use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\BookkeepingBundle\Entity\Transaction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="Asiel\CustomerBundle\Repository\CustomerRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap(
 *     {"Customer" = "Customer",
 *     "PrivateCustomer" = "Asiel\CustomerBundle\Entity\PrivateCustomer",
 *     "BusinessCustomer" = "Asiel\CustomerBundle\Entity\BusinessCustomer"})
 */
class Customer
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
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\Adopted", mappedBy="customer")
     */
    private $adoptedPets;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\Found", mappedBy="foundBy")
     */
    private $foundAnimals;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner", mappedBy="owner")
     */
    private $ownsAnimals;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\Abandoned", mappedBy="abandonedBy")
     */
    private $abandonedAnimals;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\BookkeepingBundle\Entity\Transaction", mappedBy="customer")
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\BookkeepingBundle\Entity\Action", mappedBy="customer")
     */
    private $actions;

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
     * Constructor
     */
    public function __construct()
    {
        $this->adoptedPets = new ArrayCollection();
        $this->foundAnimals = new ArrayCollection();
        $this->ownsAnimals = new ArrayCollection();
        $this->abandonedAnimals = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->actions = new ArrayCollection();
    }

    /**
     * Add adoptedPet
     *
     * @param Adopted $adoptedPet
     *
     * @return Customer
     */
    public function addAdoptedPet(Adopted $adoptedPet)
    {
        $this->adoptedPets[] = $adoptedPet;

        return $this;
    }

    /**
     * Remove adoptedPet
     *
     * @param Adopted $adoptedPet
     */
    public function removeAdoptedPet(Adopted $adoptedPet)
    {
        $this->adoptedPets->removeElement($adoptedPet);
    }

    /**
     * Get adoptedPets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdoptedPets()
    {
        return $this->adoptedPets;
    }

    /**
     * Add foundAnimal
     *
     * @param Found $foundAnimal
     *
     * @return Customer
     */
    public function addFoundAnimal(Found $foundAnimal)
    {
        $this->foundAnimals[] = $foundAnimal;

        return $this;
    }

    /**
     * Remove foundAnimal
     *
     * @param Found $foundAnimal
     */
    public function removeFoundAnimal(Found $foundAnimal)
    {
        $this->foundAnimals->removeElement($foundAnimal);
    }

    /**
     * Get foundAnimals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFoundAnimals()
    {
        return $this->foundAnimals;
    }

    /**
     * Add ownsAnimal
     *
     * @param ReturnedOwner $ownsAnimal
     *
     * @return Customer
     */
    public function addOwnsAnimal(ReturnedOwner $ownsAnimal)
    {
        $this->ownsAnimals[] = $ownsAnimal;

        return $this;
    }

    /**
     * Remove ownsAnimal
     *
     * @param ReturnedOwner $ownsAnimal
     */
    public function removeOwnsAnimal(ReturnedOwner $ownsAnimal)
    {
        $this->ownsAnimals->removeElement($ownsAnimal);
    }

    /**
     * Get ownsAnimals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOwnsAnimals()
    {
        return $this->ownsAnimals;
    }

    /**
     * Add abandonedAnimal
     *
     * @param Abandoned $abandonedAnimal
     *
     * @return Customer
     */
    public function addAbandonedAnimal(Abandoned $abandonedAnimal)
    {
        $this->abandonedAnimals[] = $abandonedAnimal;

        return $this;
    }

    /**
     * Remove abandonedAnimal
     *
     * @param Abandoned $abandonedAnimal
     */
    public function removeAbandonedAnimal(Abandoned $abandonedAnimal)
    {
        $this->abandonedAnimals->removeElement($abandonedAnimal);
    }

    /**
     * Get abandonedAnimals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbandonedAnimals()
    {
        return $this->abandonedAnimals;
    }

    /**
     * Add transaction
     *
     * @param Transaction $transaction
     *
     * @return Customer
     */
    public function addTransaction(Transaction $transaction)
    {
        $this->transactions[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param Transaction $transaction
     */
    public function removeTransaction(Transaction $transaction)
    {
        $this->transactions->removeElement($transaction);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Add action
     *
     * @param Action $action
     *
     * @return Customer
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param Action $action
     */
    public function removeAction(Action $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    public function getName() : string
    {
        if ($this instanceof PrivateCustomer) {
            return $this->getFirstname().' '.$this->getLastname();
        }

        if ($this instanceof BusinessCustomer) {
            return $this->getCompanyName();
        }

        return 'Unknown';
    }

    public function getContactName()
    {
        if ($this instanceof BusinessCustomer) {
            return $this->getContactFirstname().' '.$this->getContactLastname();
        }

        return 'Unknown';
    }

    public function isPrivate() : bool
    {
        if ($this instanceof PrivateCustomer) {
            return true;
        }

        return false;
    }

    public function isBusiness() : bool
    {
        if ($this instanceof BusinessCustomer) {
            return true;
        }

        return false;
    }


}
