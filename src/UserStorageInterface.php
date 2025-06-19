<?php

namespace Pavel\Db;

interface UserStorageInterface
{
    public function newUser();

    public function showUsers();

    public function deleteUser($id);

//    public function saveUser(string $storage, array $newData );

//    public function getLastId();

    public function createUser();
}

