<?php

declare(strict_types=1);

namespace Psl\IO;

use Psl\DateTime\Duration;
use Psl\IO;

/**
 * @codeCoverageIgnore
 */
final class SeekReadStreamHandle implements SeekReadStreamHandleInterface
{
    use IO\ReadHandleConvenienceMethodsTrait;

    private SeekReadStreamHandleInterface $handle;

    /**
     * @param resource $stream
     */
    public function __construct(mixed $stream)
    {
        $this->handle = new Internal\ResourceHandle($stream, read: true, write: false, seek: true, close: false);
    }

    /**
     * {@inheritDoc}
     */
    public function reachedEndOfDataSource(): bool
    {
        return $this->handle->reachedEndOfDataSource();
    }

    /**
     * {@inheritDoc}
     */
    public function tryRead(null|int $max_bytes = null): string
    {
        return $this->handle->tryRead($max_bytes);
    }

    /**
     * {@inheritDoc}
     */
    public function read(null|int $max_bytes = null, null|Duration $timeout = null): string
    {
        return $this->handle->read($max_bytes, $timeout);
    }

    /**
     * {@inheritDoc}
     */
    public function seek(int $offset): void
    {
        $this->handle->seek($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function tell(): int
    {
        return $this->handle->tell();
    }

    /**
     * {@inheritDoc}
     */
    public function getStream(): mixed
    {
        return $this->handle->getStream();
    }
}
