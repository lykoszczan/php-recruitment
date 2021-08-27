<?php


namespace PiwikPRO\WriteHandlers;


use UserStub\User;
use WriterStub\DatabaseWriter;

class Database
{
    /**
     * @var DatabaseWriter
     */
    private DatabaseWriter $db;

    public function __construct(string $host, string $database, string $user, string $password)
    {
        $this->db = new DatabaseWriter($host, $database, $user, $password);
    }

    /**
     * @param User[] $users
     * @return array
     */
    public function saveToDatabase(array $users): array {
        $result = [];
        $this->db->connect();

        foreach ($users as $user) {
            $result[] = $this->db->insert($user);
        }

        return $result;
    }
}