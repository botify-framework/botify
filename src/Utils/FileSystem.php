<?php

namespace Botify\Utils;

use Amp\File;
use Amp\Promise;
use function Amp\call;
use function Botify\abs_path;


class FileSystem
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->path;
    }

    /**
     * @return Promise
     */
    public function accessedAt(): Promise
    {
        return File\getAccessTime($this->path);
    }

    /**
     * @param string $link
     * @return Promise
     */
    public function createHardLink(string $link): Promise
    {
        return File\createHardlink($this->path, $link);
    }

    /**
     * @param string $link
     * @return Promise
     */
    public function createSymlink(string $link): Promise
    {
        return File\createSymlink($this->path, $link);
    }

    /**
     * @return Promise
     */
    public function createdAt(): Promise
    {
        return File\getCreationTime($this->path);
    }

    /**
     * @return Promise
     */
    public function delete(): Promise
    {
        return File\deleteFile($this->path);
    }

    /**
     * @return Promise
     */
    public function get(): Promise
    {
        return $this->read($this->path);
    }

    /**
     * @return string
     */
    public function getAbsolutePath(): string
    {
        return abs_path($this->path);
    }

    /**
     * @return string
     */
    public function getBaseName(): string
    {
        return basename($this->path);
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return pathinfo($this->path, PATHINFO_EXTENSION);
    }

    /**
     * @return Promise
     */
    public function getLinkStatus(): Promise
    {
        return File\getLinkStatus($this->path);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Promise
     */
    public function getSize(): Promise
    {
        return File\getSize($this->path);
    }

    /**
     * @return Promise
     */
    public function getStatus(): Promise
    {
        return File\getStatus($this->path);
    }

    /**
     * @return Promise
     */
    public function isDir(): Promise
    {
        return File\isDirectory($this->path);
    }

    /**
     * @return Promise
     */
    public function isExists(): Promise
    {
        return File\isFile($this->path);
    }

    /**
     * @return bool
     */
    public function isReadable(): bool
    {
        return is_readable($this->path);
    }

    /**
     * @return Promise
     */
    public function isSymlink(): Promise
    {
        return File\isSymlink($this->path);
    }

    /**
     * @return bool
     */
    public function isWriteable(): bool
    {
        return is_writable($this->path);
    }

    /**
     * @return Promise
     */
    public function modifiedAt(): Promise
    {
        return File\getModificationTime($this->path);
    }

    /**
     * @param string $mode
     * @return Promise
     */
    public function open(string $mode): Promise
    {
        return File\openFile($this->path, $mode);
    }

    /**
     * @param string $contents
     * @return Promise
     */
    public function put(string $contents): Promise
    {
        return $this->write($contents);
    }

    /**
     * @return Promise
     */
    public function read(): Promise
    {
        return File\read($this->path);
    }

    /**
     * @param $to
     * @return Promise
     */
    public function rename($to): Promise
    {
        return $this->move($to);
    }

    /**
     * @param $to
     * @return Promise
     */
    public function move($to): Promise
    {
        return File\move($this->path, $to);
    }

    public function touch(): Promise
    {
        return call(function () {
            if (yield File\isDirectory($dir = $this->getDirName())) {
                File\createDirectoryRecursively($dir, 0755);
            }

            return File\touch($this->path);
        });
    }

    /**
     * @return string
     */
    public function getDirName(): string
    {
        return dirname($this->path);
    }

    /**
     * @param string $data
     * @return Promise
     */
    public function write(string $data): Promise
    {
        return File\write($this->path, $data);
    }
}