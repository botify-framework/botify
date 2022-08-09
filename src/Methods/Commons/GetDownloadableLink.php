<?php

namespace Botify\Methods\Commons;

use Amp\Promise;
use function Amp\call;
use function Botify\config;

trait GetDownloadableLink
{
    /**
     * @param string $fileId
     * @return Promise<array>
     */
    protected function getDownloadableLink(string $fileId): Promise
    {
        return call(function () use ($fileId) {
            $file = yield $this->getFile(
                file_id: $fileId
            );

            if ($file->isSuccess()) {
                return [
                    $file->file_path,
                    sprintf('%s/file/bot%s/%s', rtrim(config('telegram.base_uri')), config('telegram.token'), $file->file_path)
                ];
            }

            return false;
        });
    }
}