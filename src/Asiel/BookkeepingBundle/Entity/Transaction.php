<?php

namespace Asiel\BookkeepingBundle\Entity;

use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CustomerBundle\Entity\Customer;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="Asiel\BookkeepingBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @ORM\ManyToOne(targetEntity="Asiel\CustomerBundle\Entity\Customer", inversedBy="transactions")
     */
    private $customer;

    /**
     * @var int
     *
     * @ORM\Column(name="paid_amount", type="float")
     */
    private $paidAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_type", type="string", length=100)
     */
    private $paymentType;


    /**
     * @ORM\ManyToOne(targetEntity="Asiel\BookkeepingBundle\Entity\Action", inversedBy="transaction")
     */
    private $action;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="date")
     */
    private $dueDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="deposit", type="boolean")
     */
    private $deposit;

    /**
     * @var bool
     *
     * @ORM\Column(name="in_full", type="boolean")
     */
    private $inFull;

    /**
     * @var bool
     *
     * @ORM\Column(name="paid", type="boolean", nullable=true)
     */
    private $paid;

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
     * Set paidAmount
     *
     * @param integer $paidAmount
     *
     * @return Transaction
     */
    public function setPaidAmount($paidAmount)
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    /**
     * Get paidAmount
     *
     * @return int
     */
    public function getPaidAmount()
    {
        return $this->paidAmount;
    }

    /**
     * Set paymentType
     *
     * @param string $paymentType
     *
     * @return Transaction
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transaction
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
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Transaction
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set deposit
     *
     * @param boolean $deposit
     *
     * @return Transaction
     */
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;

        return $this;
    }

    /**
     * Get deposit
     *
     * @return bool
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * Set inFull
     *
     * @param boolean $inFull
     *
     * @return Transaction
     */
    public function setInFull($inFull)
    {
        $this->inFull = $inFull;

        return $this;
    }

    /**
     * Get inFull
     *
     * @return bool
     */
    public function getInFull()
    {
        return $this->inFull;
    }

    /**
     * Set action
     *
     * @param Action $action
     *
     * @return Transaction
     */
    public function setAction(Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     *
     * @return Transaction
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

    public function isOverDue() : bool
    {
        $now = new DateTime('today');
        $date = $this->getDueDate();

        if ($date->getTimestamp() < $now->getTimestamp()) {
            return true;
        }

        return false;
    }

    /**
     * Set paid
     *
     * @param boolean $paid
     *
     * @return Transaction
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return boolean
     */
    public function isPaid()
    {
        return $this->paid;
    }
}
