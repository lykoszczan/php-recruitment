<?php


namespace PiwikPRO\ReadHandlers;


use SplFileInfo;

interface HandlerInterface
{
    /**
     * @param SplFileInfo $file
     * @return array
     */
    public function handleRead(SplFileInfo $file): array;
}