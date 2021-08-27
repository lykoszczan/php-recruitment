<?php


namespace PiwikPRO\ReadHandlers;

use ReaderStub\XmlReader;
use SplFileInfo;
use UserStub\User;

class XmlHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handleRead(SplFileInfo $file): array
    {
        $fileObject = $file->openFile();
        $contents = $fileObject->fread($fileObject->getSize());
        $xml = new XmlReader($contents);

        $users = [];
        $usersXml = (array)$xml->toArray()['user'];
        foreach ($usersXml as $userData) {
            $users[] = new User($userData['username'], $userData['email']);
        }

        return $users;
    }
}