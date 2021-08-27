<?php

namespace WriterStub;

use UserStub\User;

class DatabaseWriter
{
    private bool $connected;

    private string $host;
    private string $database;
    private string $user;
    private string $password;

    public function __construct(string $host, string $database, string $user, string $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect(): void
    {
        if (empty($this->host) || empty($this->database) || empty($this->user) || empty($this->password)) {
            throw new \RuntimeException("Couldn't establish database connection");
        }

        $this->connected = true;
    }

    public function insert(User $user): string
    {
        if (!$this->connected) {
            throw new \RuntimeException("Couldn't find database");
        }

        return sprintf('User with email: %s added to database', $user->getEmail());
    }
}
