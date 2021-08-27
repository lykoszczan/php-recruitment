<?php


namespace PiwikPRO\WriteHandlers;


use UserStub\User;
use WriterStub\EmailWriter;

class Email
{
    /**
     * @param User[] $users
     * @return array
     */
    public function send(array $users): array {
        $result = [];

        $emailWriter = new EmailWriter();
        foreach ($users as $user) {
            $userEmail = new \EmailStub\Email($user->getEmail(), 'Welcome', 'You were imported!');
            $result[] = $emailWriter->send($userEmail);
        }

        return $result;
    }
}