<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Service\BaseFormHandler;

class TransactionFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function getBaseFormHandler() : BaseFormHandler
    {
        return $this->baseFormHandler;
    }

    public function findAnimal(int $animalId): Animal
    {
        return $this->baseFormHandler->findAnimal($animalId);
    }

    public function findAction(int $actionId): Action
    {
        return $this->baseFormHandler->findAction($actionId);
    }

    public function findCustomer(int $customerId): Customer
    {
        return $this->baseFormHandler->findCustomer($customerId);
    }

    public function findTransaction(int $transactionId) : Transaction
    {
        return $this->baseFormHandler->findTransaction($transactionId);
    }

    public function create(Action $action, Customer $customer, Transaction $transaction)
    {
        // Is transaction a deposit or in full
        if ($action->getTotalCosts() == $transaction->getPaidAmount()) {
            $transaction->setDeposit(false);
            $transaction->setInFull(true);
        } else {
            $transaction->setDeposit(true);
            $transaction->setInFull(false);
        }

        // Is transaction paid ?
        if ($transaction->getPaymentType() == 'Cash' || $transaction->getPaymentType() == 'Bank') {
            $transaction->setPaid(true);
        } else {
            $transaction->setPaid(false);
        }

        $transaction->setCustomer($customer);
        $transaction->setAction($action);

        $this->baseFormHandler->getEm()->persist($transaction);
        $this->baseFormHandler->getEm()->flush();

        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS,
                "Transactie aangemaakt."));

    }

    public function sumLargerThanRemainingMessage()
    {
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::DANGER,
                "Het betaalde bedrag kan niet hoger zijn dan het resterende bedrag."));
    }

    public function payTransaction(Transaction $transaction)
    {
        $transaction->setPaid(true);
        $this->getBaseFormHandler()->getEm()->flush();

        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS,
                "Transactie status is nu voldaan."));
    }
}