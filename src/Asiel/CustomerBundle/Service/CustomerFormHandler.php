<?php

namespace Asiel\CustomerBundle\Service;

use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CustomerBundle\Entity\BusinessCustomer;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Entity\IDCard;
use Asiel\CustomerBundle\Entity\PrivateCustomer;
use Asiel\CustomerBundle\Repository\CustomerRepository;
use Asiel\Shared\Service\BaseFormHandler;
use Symfony\Component\HttpFoundation\RequestStack;

class CustomerFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function findCustomer(int $customerId): Customer
    {
        return $this->baseFormHandler->findCustomer($customerId);
    }

    public function edit(Customer $customer, $idCardFile)
    {
        if ($idCardFile) {
            // Skip if customer already has a card
            if ($customer->getIdCard()) {
                $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
                    new UserAlertEvent(UserAlertEvent::DANGER, 'Deze klant heeft al een ID kaart.'));

                return;
            }

            $IDCardentity = new IDCard();
            $idCardXML = simplexml_load_file($idCardFile);

            $IDCardentity->setNationalnumber($idCardXML->identity->attributes()['nationalnumber']);
            $IDCardentity->setDayOfBirth($idCardXML->identity->attributes()['dateofbirth']);
            $IDCardentity->setGender($idCardXML->identity->attributes()['gender']);
            $IDCardentity->setName($idCardXML->identity->name);
            $IDCardentity->setFirstname($idCardXML->identity->firstname);
            $IDCardentity->setMiddlenames($idCardXML->identity->middlenames);
            $IDCardentity->setNationality($idCardXML->identity->nationality);
            $IDCardentity->setPlaceofbirth($idCardXML->identity->placeofbirth);
            $IDCardentity->setPhoto($idCardXML->identity->photo);
            $IDCardentity->setDocumenttype($idCardXML->card->attributes()['documenttype']);
            $IDCardentity->setCardnumber($idCardXML->card->attributes()['cardnumber']);
            $IDCardentity->setChipnumber($idCardXML->card->attributes()['chipnumber']);
            $IDCardentity->setValiditydatebegin($idCardXML->card->attributes()['validitydatebegin']);
            $IDCardentity->setValiditydateend($idCardXML->card->attributes()['validitydateend']);
            $IDCardentity->setDeliverymunicipality($idCardXML->card->deliverymunicipality);
            $IDCardentity->setStreetandnumber($idCardXML->address->streetandnumber);
            $IDCardentity->setZip($idCardXML->address->zip);
            $IDCardentity->setMunicipality($idCardXML->address->municipality);
            $IDCardentity->setPrivateCustomer($customer);

            $this->baseFormHandler->getEm()->persist($IDCardentity);
        }


        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function createPrivate(PrivateCustomer $privateCustomer, $idCardFile)
    {
        if ($idCardFile) {
            $IDCardentity = new IDCard();
            $idCardXML = simplexml_load_file($idCardFile);

            $IDCardentity->setNationalnumber($idCardXML->identity->attributes()['nationalnumber']);
            $IDCardentity->setDayOfBirth($idCardXML->identity->attributes()['dateofbirth']);
            $IDCardentity->setGender($idCardXML->identity->attributes()['gender']);
            $IDCardentity->setName($idCardXML->identity->name);
            $IDCardentity->setFirstname($idCardXML->identity->firstname);
            $IDCardentity->setMiddlenames($idCardXML->identity->middlenames);
            $IDCardentity->setNationality($idCardXML->identity->nationality);
            $IDCardentity->setPlaceofbirth($idCardXML->identity->placeofbirth);
            $IDCardentity->setPhoto($idCardXML->identity->photo);
            $IDCardentity->setDocumenttype($idCardXML->card->attributes()['documenttype']);
            $IDCardentity->setCardnumber($idCardXML->card->attributes()['cardnumber']);
            $IDCardentity->setChipnumber($idCardXML->card->attributes()['chipnumber']);
            $IDCardentity->setValiditydatebegin($idCardXML->card->attributes()['validitydatebegin']);
            $IDCardentity->setValiditydateend($idCardXML->card->attributes()['validitydateend']);
            $IDCardentity->setDeliverymunicipality($idCardXML->card->deliverymunicipality);
            $IDCardentity->setStreetandnumber($idCardXML->address->streetandnumber);
            $IDCardentity->setZip($idCardXML->address->zip);
            $IDCardentity->setMunicipality($idCardXML->address->municipality);
            $IDCardentity->setPrivateCustomer($privateCustomer);

            $this->baseFormHandler->getEm()->persist($IDCardentity);
        }

        $this->baseFormHandler->getEm()->persist($privateCustomer);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Klant is aangemaakt.'));
    }

    public function createBusiness(BusinessCustomer $businessCustomer)
    {
        $this->baseFormHandler->getEm()->persist($businessCustomer);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Klant is aangemaakt.'));
    }

    public function getRequestStack(): RequestStack
    {
        return $this->baseFormHandler->getRequestStack();
    }

    public function getRepository(): CustomerRepository
    {
        return $this->baseFormHandler->getCustomerRepository();
    }

}