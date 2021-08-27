<?php

namespace PiwikPRO;

use ImporterStub\ImporterInterface;
use Psr\Log\LoggerInterface;

class Application implements ImporterInterface
{
    /**
     * Application constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
    }

    /**
     * @param string $sourceType
     * @param \SplFileInfo $file
     * @return array
     */
    public function read(string $sourceType, \SplFileInfo $file): array
    {
        // TODO: Implement read() method.
    }

    /**
     * @param string $destinationType
     */
    public function write(string $destinationType)
    {
        // TODO: Implement write() method.
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        // TODO: Implement setLogger() method.
    }
}
