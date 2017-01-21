<?php


namespace Asiel\AnimalBundle\Service;


use Asiel\AnimalBundle\Entity\Picture;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\PictureRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PictureFormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
    }

    /**
     * @param int $pictureId
     * @return Picture|null
     */
    public function find(int $pictureId)
    {
        $picture = $this->em->getRepository('AnimalBundle:Picture')->find($pictureId);

        if (!$picture) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Medisch dossier', $pictureId));
        }

        return $picture;
    }

    public function create(Picture $picture, int $animalId)
    {
        $picture->setAnimal($this->getAnimalRepository()->find($animalId));
        $this->em->persist($picture);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'De foto is toegevoegd aan het dier.'));
    }

    public function delete(Picture $picture)
    {
        $this->em->remove($picture);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Foto verwijderd.'));
    }

    public function getRepository() : PictureRepository
    {
        return $this->em->getRepository('AnimalBundle:Picture');
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }

}