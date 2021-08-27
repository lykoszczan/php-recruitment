<?php

namespace UserStub;

class User
{
    private string $username;
    private string $email;

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function equals(User $user): bool
    {
        return $user->getUsername() === $this->username && $user->getEmail() === $this->email;
    }
}
