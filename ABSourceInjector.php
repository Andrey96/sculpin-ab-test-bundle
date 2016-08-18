<?php

namespace Yaenergetik\Sculpin\Bundle\ABTestBundle;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\FilesystemDataSource;
use Sculpin\Core\Event\SourceSetEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ABSourceInjector implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
        );
    }

    public function beforeRun(SourceSetEvent $event)
    {
        $abDataSource = new FileSystemDataSource('source_ab', [], [], []);
        $abDataSource->refresh($event->sourceSet());
    }
}
