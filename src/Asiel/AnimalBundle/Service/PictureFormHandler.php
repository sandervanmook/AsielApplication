<?php


namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Picture;
use Asiel\AnimalBundle\Repository\PictureRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandlerTrait;

class PictureFormHandler
{
    use BaseFormHandlerTrait;

    public function find(int $pictureId): Picture
    {
        return $this->findPicture($pictureId);
    }

    public function create(Picture $picture, int $animalId)
    {
        $picture->setAnimal($this->findAnimal($animalId));
        $this->getEm()->persist($picture);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De foto is toegevoegd aan het dier.'));
    }

    public function delete(Picture $picture)
    {
        $this->getEm()->remove($picture);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Foto verwijderd.'));
    }

    public function getRepository(): PictureRepository
    {
        return $this->getPictureRepository();
    }

}