<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 26.11.2017
 * Time: 14:59
 */
namespace AppBundle\Doctrine;

use AppBundle\Entity\Uzytkownicy;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class HashPasswordListener implements EventSubscriber
{
    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    public function __construct(UserPasswordEncoder $encoder)
    {

        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if (!$entity instanceof Uzytkownicy) {
            return;
        }

        $this->encodePassword($entity);
    }

    public function preUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if (!$entity instanceof Uzytkownicy) {
            return;
        }

        $this->encodePassword($entity);
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    /**
     * @param Uzytkownicy $entity
     */
    public function encodePassword(Uzytkownicy $entity)
    {
        $encoded = $this->encoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setHaslo($encoded);
    }
}