<?php

namespace Yaenergetik\Sculpin\Bundle\ABTestBundle;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\FileSource;
use Sculpin\Core\Source\SourceSet;
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
        $sources = [];
        foreach ($event->sourceSet()->updatedSources() as $source) {
            if ($source instanceof FileSource) {
                $path = 'source_ab/'.$source->relativePathname();
                if (file_exists($path)) {
                    $sources[] = new ABFileSource($source, $path);
                }
            }
        }
        foreach ($sources as $source) {
            $source->setHasChanged();
            $event->sourceSet()->mergeSource($source);
        }
    }
}
