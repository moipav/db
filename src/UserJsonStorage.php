<?php

namespace Pavel\Db;

use Faker\Factory;

class UserJsonStorage implements UserStorageInterface
{
    private string $filename = 'users.json';
    private array $usersOnArray;

    public function __construct()
    {

        if (!file_exists($this->filename)) {
            $this->usersOnArray = [];
        }
        $json = file_get_contents($this->filename);
        $this->usersOnArray = json_decode($json, true) ?: [];
    }
    #[\Override] public function newUser()
    {
        $faker = Factory::create();
        $lastID = $this->getLastId($this->usersOnArray);
        $new_user = [
            "id" => ++$lastID,
            "name" => $faker->name,
            "surname" => $faker->lastName,
            "email" => $faker->email,
            "year_of_birth" => $faker->year,
            "date_to_created" => date("d-m-Y H:i:s")
        ];
        $this->usersOnArray[] = $new_user;
        return $this->usersOnArray;
    }


    private function saveUser(string $storage, array $newData)
    {
        $dataJSON = json_encode($newData);
        file_put_contents($storage, $dataJSON);
    }


    #[\Override] public function createUser(): void
    {
        $this->saveUser($this->filename, $this->newUser());
    }
    public function getFilename()
    {
        return $this->filename;
    }

    #[\Override] public function showUsers()
    {
        foreach ($this->usersOnArray as $users) {
            foreach ($users as $k => $v) {
                echo $k . ": " .$v . "\n";
            }
            echo "\n-------------------------------------------\n";
        }
    }
    #[\Override] public function deleteUser($id)
    {
        foreach ($this->usersOnArray as $k => $value) {
            if ($value["id"]  == $id) {
                unset($this->usersOnArray[$k]);
            }
        }
        $this->saveUser($this->filename, (array)$this->usersOnArray);
    }
    private function getLastId()
    {
        return !empty($this->usersOnArray) ? $this->usersOnArray[array_key_last((array)$this->usersOnArray)]["id"] : 0;
    }
}