<?php

    namespace App\EventSubscriber;

use App\Entity\Invitation;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent; 
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Uid\Uuid;

    class EasyAdminSubscriber implements EventSubscriberInterface {
        public static function getSubscribedEvents()
        {
            // beforeEntityPersistedEvent : get va s'aboner au before avant persister l'entité 
           return [ BeforeEntityPersistedEvent::class => ['setUuid'], 
        
        ]; 

        }

        public function setUuid(BeforeEntityPersistedEvent $event) {
            // on récupère l'event et recupérer l'invitation et filter avec instanceof 
            $entity = $event->getEntityInstance(); 
            if(($entity instanceof Invitation)){
                $entity->setUuid(Uuid::v4()); 
            }
        }
    }
?>