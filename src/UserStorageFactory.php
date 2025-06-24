<?php

namespace Pavel\Db;

class UserStorageFactory
{

    public static function create($type)
    {
        if ($type === 'json') {
            return new UserJsonStorage();
        } elseif ($type === 'db') {
            return new UserDbStorage();
        }
    }
}