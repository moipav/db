<?php

namespace Pavel\Db;

class Users
{

    protected UserStorageInterface $storage;

    public function __construct(UserStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function createUser(): void
    {
        $this->storage->createUser();
    }

    public function showUsers()
    {
        return $this->storage->showUsers();
    }

    public function deleteUser($id): void
    {
        $this->storage->deleteUser($id);
    }

    public function createRealUser($newUser): void
    {
        $this->storage->createRealUser($newUser);
    }
}