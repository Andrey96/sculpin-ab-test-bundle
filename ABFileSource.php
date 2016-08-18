<?php

namespace Yaenergetik\Sculpin\Bundle\ABTestBundle;

use Sculpin\Core\Source\FileSource;
use Symfony\Component\Finder\SplFileInfo;

class ABFileSource extends FileSource
{
    public function __construct(FileSource $source, string $path)
    {
        $this->analyzer = $source->analyzer;
        $this->sourceId = $source->sourceId;
        $this->relativePathname = $source->relativePathname;
        $this->filename = $source->filename;
        $this->file = new SplFileInfo($path, $source->file->getRelativePath(), $source->file->getRelativePathname());
        $this->isRaw = $source->isRaw;
        $this->hasChanged = true;
        $this->applicationXmlType = $source->applicationXmlType;
        $this->init();
    }
}
