<?php

namespace Jove\Traits;

use Amp\File;
use Amp\Promise;
use Jove\Utils\FileSystem;
use function Amp\call;

trait Downloadable
{
    /**
     * @param $dist
     * @return Promise
     */
    public function download($dist = null): Promise
    {
        return call(function () use ($dist) {
            if ($fileId = $this->getDownloadableId()) {
                if ([$path, $link] = yield $this->getAPI()->getDownloadableLink($fileId)) {
                    if (!yield File\isDirectory($dir = dirname($path = $dist ?? storage_path($path)))) {
                        yield File\createDirectoryRecursively($dir, 0755);
                    }

                    if ($file = yield File\openFile($path, 'c+')) {
                        $body = yield $this->getAPI()->get($link, stream: true);

                        while (null !== $chunk = yield $body->read(1024)) {
                            $file->write($chunk);
                        }

                        yield $file->close();

                        return new FileSystem($path);
                    }
                }
            }

            return false;
        });
    }

    abstract public function getDownloadableId(): string;
}