<?php

namespace Asiel\BookkeepingBundle\Entity;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\CustomerBundle\Entity\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 *
 * @ORM\Table(name="action")
 * @ORM\Entity(repositoryClass="Asiel\BookkeepingBundle\Repository\ActionRepository")
 */
class Action
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
     * @ORM\OneToMany(targetEntity="Asiel\BookkeepingBundle\Entity\Transaction", mappedBy="action")
     */
    private $transaction;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="total_costs", type="float")
     */
    private $totalCosts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\AnimalBundle\Entity\Animal", inversedBy="actions")
     */
    private $animal;

    /**
     * @var bool
     *
     * @ORM\Column(name="fully_paid", type="boolean")
     */
    private $fullyPaid;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\CustomerBundle\Entity\Customer", inversedBy="actions")
     */
    private $customer;

    /**
     * @var bool
     *
     * @ORM\Column(name="completed", type="boolean")
     */
    private $completed;

    /**
     * @ORM\OneToOne(targetEntity="Asiel\AnimalBundle\Entity\Status", inversedBy="action")
     */
    private $status;

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
     * Set type
     *
     * @param string $type
     *
     * @return Action
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set totalCosts
     *
     * @param integer $totalCosts
     *
     * @return Action
     */
    public function setTotalCosts($totalCosts)
    {
        $this->totalCosts = $totalCosts;

        return $this;
    }

    /**
     * Get totalCosts
     *
     * @return int
     */
    public function getTotalCosts()
    {
        return $this->totalCosts;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Action
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transaction = new ArrayCollection();
    }

    /**
     * Add transaction
     *
     * @param Transaction $transaction
     *
     * @return Action
     */
    public function addTransaction(Transaction $transaction)
    {
        $this->transaction[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param Transaction $transaction
     */
    public function removeTransaction(Transaction $transaction)
    {
        $this->transaction->removeElement($transaction);
    }

    /**
     * Get transaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransaction()
    {
        return $this->transaction;
    }


    /**
     * Set animal
     *
     * @param Animal $animal
     *
     * @return Action
     */
    public function setAnimal(Animal $animal = null)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return \Asiel\AnimalBundle\Entity\Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    public function isFullyPaid()
    {
        return $this->fullyPaid;
    }

    public function setFullyPaid(Bool $bool)
    {
        $this->fullyPaid = $bool;
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     *
     * @return Action
     */
    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    public function sumRemaining()
    {
        // Nothing has been paid
        if ($this->getTransaction()->isEmpty()) {
            return $this->totalCosts;
        } else {
            $paid = 0;
            foreach ($this->getTransaction() as $transaction) {
                $paid += $transaction->getPaidAmount();
            }
            return $this->totalCosts - $paid;
        }
    }

    public function setCompleted(Bool $bool)
    {
        $this->completed = $bool;
    }

    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * Get fullyPaid
     *
     * @return boolean
     */
    public function getFullyPaid()
    {
        return $this->fullyPaid;
    }

    /**
     * Get completed
     *
     * @return boolean
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set status
     *
     * @param Status $status
     *
     * @return Action
     */
    public function setStatus(Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
