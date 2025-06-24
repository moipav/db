<?php

use Pavel\Db\Users;
use Pavel\Db\UserStorageFactory;

require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = UserStorageFactory::create($_ENV['DB_SOURCE']);
$user = new Users($db);

/*******Menu***********/

function printMenu()
{
    echo "Выберете пункт меню:\n
    1. Посмотреть всех пользователей\n
    2. Добавить пользвателя (пользватель создвстся автоматически\n
    3. Удалить пользователя\n
    0. Выход \n
    Ваш выбор:
    ";
}


printMenu();
$line = trim(fgets(STDIN));

switch ($line) {
    case 1:
        $user->showUsers();
        break;
    case 2:
        $user->createUser();
        break;
    case 3:
        echo "Введите ID пользвателя, которого хотите удалить:\n";
        $id = trim(fgets(STDIN));
        $user->deleteUser($id);
        break;
    case 0: break;
    default: echo "Вы выбрали не существующий пункт меню";
}
