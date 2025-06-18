<?php

namespace Pavel\Db;

use Faker\Factory;

class UserDbStorage implements UserStorageInterface
{
    private $DB;
    private array $usersOnArray;

    public function __construct()
    {
        $this->DB = new Databasee();
    }
    #[\Override] public function newUser()
    {
        $faker = Factory::create();
//        $lastID = $this->getLastId($this->usersOnArray);
        $new_user = [
//            "id" => ++$lastID,
            "name" => $faker->name,
            "surname" => $faker->lastName,
            "email" => $faker->email,
            "year_of_birth" => $faker->year,
            "date_to_created" => date("d-m-Y H:i:s")
        ];
        $this->usersOnArray[] = $new_user;
        return $new_user;
    }

    #[\Override] public function createUser()
    {
        $new_user = $this->newUser();
//        var_dump($new_user);
        $params = [
            'name' => $new_user['name'],
            'surname' => $new_user['surname'],
            'email' => $new_user['email'],
            'year_of_birth' => (int)$new_user['year_of_birth']
        ];
        $this->DB->query("INSERT INTO `users`(name, surname, email, year_of_birth) VALUES (:name,:surname,:email, :year_of_birth)");
//        foreach ($params as $param => $value) {
//            $this->DB->bind($param, $value,);
//        }
        $this->DB->execute($params);
    }

    #[\Override] function saveUser(string $storage, array $newData)
    {
        // TODO: Implement saveUser() method.
    }

    #[\Override] public function showUsers()
    {
        $this->DB->query("SELECT * FROM users");
        $result = $this->DB->resultSet();
        echo __CLASS__;
        echo "\n" . __METHOD__;
        var_dump($result);
    }

    #[\Override] public function deleteUser($id)
    {
        // TODO: Implement deleteUser() method.
    }

    #[\Override] public function getLastId()
    {
        // TODO: Implement getLastId() method.
    }
}