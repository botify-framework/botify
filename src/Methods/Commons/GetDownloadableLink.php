<?php

namespace Jove\Methods\Commons;

use Amp\Promise;
use function Amp\call;

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
                    sprintf(
                        '%s/file/bot%s/%s',
                        rtrim(config('telegram.base_uri')),
                        getenv('BOT_TOKEN'), $file->file_path
                    )
                ];
            }

            return false;
        });
    }
}