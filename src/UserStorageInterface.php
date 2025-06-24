<?php

namespace Pavel\Db;

interface UserStorageInterface
{
    public function newUser();

    public function showUsers();

    public function deleteUser($id);

    public function createUser();
}

