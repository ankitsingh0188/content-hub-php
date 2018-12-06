<?php

namespace Acquia\ContentHubClient\EventSubscriber;

use Acquia\ContentHubClient\ContentHubLibraryEvents;
use Acquia\ContentHubClient\CDF\ClientCDFObject;
use Acquia\ContentHubClient\Event\GetCDFTypeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * The Configuration entity CDF creator.
 *
 * @see \Drupal\acquia_contenthub\Event\CreateCDFEntityEvent
 */
class ClientCDF implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ContentHubLibraryEvents::GET_CDF_CLASS][] = ['onGetCDFType', 100];
    return $events;
  }

  public function onGetCDFType(GetCDFTypeEvent $event) {
    if ($event->getType() === 'client') {
      $data = $event->getData();
      $object = new ClientCDFObject($data['uuid'], $data['metadata']);
      $event->setObject($object);
      $event->stopPropagation();
    }
  }
}