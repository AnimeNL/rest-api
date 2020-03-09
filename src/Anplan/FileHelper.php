<?php

namespace App\Anplan;

class FileHelper
{
    private const OFFSET_FILENAME = 0;
    private const OFFSET_MIMETYPE = 1;
    private const OFFSET_TIMESTAMP = 2;
    private const OFFSET_CONTENTS = 3;

    private string $filename;
    private string $extension;
    private string $mimeType;
    private string $timestamp;
    private string $contents;

    public function __construct($resource)
    {
        $data = explode("\t", stream_get_contents($resource));

        // TODO: Figure out why this can happen?
        if (!array_key_exists(1, $data)) {
            $this->filename = '';
            $this->extension = '';
            $this->mimeType = '';
            $this->timestamp = '';
            $this->contents = '';

            return;
        }

        $this->filename = $data[self::OFFSET_FILENAME];
        $this->mimeType = $data[self::OFFSET_MIMETYPE];
        $this->timestamp = $data[self::OFFSET_TIMESTAMP];

        $this->contents = implode("\t", array_slice($data, self::OFFSET_CONTENTS));

        $this->extension = pathinfo($data[0], PATHINFO_EXTENSION);
    }

    public static function fromResource($resource): FileHelper
    {
        return new self($resource);
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function getContents(): string
    {
        return $this->contents;
    }
}
