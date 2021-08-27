<?php

namespace WriterStub;

use EmailStub\Email;

class EmailWriter
{
    public function send(Email $email): string
    {
        if (!$email->getTo()) {
            throw new \UnexpectedValueException('"to" field can not be empty');
        }

        if (!$email->getSubject()) {
            throw new \UnexpectedValueException('"subject" field can not be empty');
        }

        return sprintf('Email sent to: %s', $email->getTo());
    }
}
