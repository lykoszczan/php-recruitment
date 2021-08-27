<?php


namespace PiwikPRO\ReadHandlers;

use ReaderStub\CsvReader;
use SplFileInfo;
use UserStub\User;

class CsvHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handleRead(SplFileInfo $file): array
    {
        $csvReader = new CsvReader($file->openFile());

        $users = [];
        while($csvReader->valid() )
        {
            $values = $csvReader->current();
            $users[] = new User($values[0], $values[1]);
            $csvReader->next();
        }

        return $users;
    }
}