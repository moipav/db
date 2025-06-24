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

        $new_user = [
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
        $params = [
            'name' => $new_user['name'],
            'surname' => $new_user['surname'],
            'email' => $new_user['email'],
            'year_of_birth' => (int)$new_user['year_of_birth']
        ];
        $this->DB->query("INSERT INTO `users`(name, surname, email, year_of_birth) VALUES (:name,:surname,:email, :year_of_birth)");
        $this->DB->execute($params);
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
        $this->DB->query("DELETE FROM users WHERE id = :id");
        $this->DB->execute(['id' => $id]);
    }


}