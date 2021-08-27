<?php

namespace ImporterStub;

use Psr\Log\LoggerAwareInterface;

interface ImporterInterface extends LoggerAwareInterface
{
    public function read(string $sourceType, \SplFileInfo $file): array;

    public function write(string $destinationType);
}
