<?php

namespace Pavel\Db;

use Faker\Factory;

class Users
{


    protected UserStorageInterface $storage;

    public function __construct(UserStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    private function newUser()
    {

    }

    public function createUser(): void
    {
        $this->storage->createUser();
    }

    public function showUsers(): void
    {
        $this->storage->showUsers();
    }

    public function deleteUser($id): void
    {
        $this->storage->deleteUser($id);
    }
}