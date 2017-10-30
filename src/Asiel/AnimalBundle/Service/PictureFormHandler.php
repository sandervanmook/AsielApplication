<?php


namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Picture;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\PictureRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandler;

class PictureFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function find(int $pictureId): Picture
    {
        return $this->baseFormHandler->findPicture($pictureId);
    }

    public function create(Picture $picture, int $animalId)
    {
        $picture->setAnimal($this->baseFormHandler->findAnimal($animalId));
        $this->baseFormHandler->getEm()->persist($picture);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De foto is toegevoegd aan het dier.'));
    }

    public function delete(Picture $picture)
    {
        $this->baseFormHandler->getEm()->remove($picture);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Foto verwijderd.'));
    }

    public function getRepository(): PictureRepository
    {
        return $this->baseFormHandler->getPictureRepository();
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->baseFormHandler->getAnimalRepository();
    }

}