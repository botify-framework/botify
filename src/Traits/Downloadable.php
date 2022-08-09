<?php

namespace Botify\Traits;

use Amp\File;
use Amp\Promise;
use Botify\Utils\FileSystem;
use function Amp\call;
use function Botify\static_path;
use function Botify\storage_path;

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
                    if (!yield File\isDirectory($dir = dirname($path = $dist ?? storage_path('/static/' . $path)))) {
                        yield File\createDirectoryRecursively($dir, 0755);
                    }

                    if ($file = yield File\openFile($path, 'c+')) {
                        $body = yield $this->getAPI()->getClient()->get($link);
                        $stream = $body->stream();

                        while (null !== $chunk = yield $stream->read(1024)) {
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