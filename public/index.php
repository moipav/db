<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="/list-users">Посмотреть список всех пользователей</a> |
<a href="/create-user">Добавить пользвателя</a>
<?= !empty($users) ?>
<?= !empty($form) ?>
</body>
</html>


<?php
require_once '../vendor/autoload.php';

use Pavel\Db\UserStorageFactory;
use Pavel\Db\Users;


$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
$db = UserStorageFactory::create($_ENV['DB_SOURCE']);
$user = new Users($db);

/*******Menu***********/

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', trim($uri, '/'));
if ($segments[0] == 'list-users') {
    http_response_code(200);
    $users = $user->showUsers();
    $users = require_once 'users.php';
} elseif ($segments[0] == 'create-user') {
    http_response_code(200);
    $form = require_once 'form.php';
} elseif ($segments[0] == 'create_user') {
    http_response_code(201);
    $user->createRealUser($_POST);
} elseif ($segments[0] == 'delete') {
    http_response_code(200);
    $user->deleteUser($_GET['id']);
}

?>



<?php
/*
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
}*/


/*

/* ## Третий этап

Теперь нам необходимо продублировать все те же операции над пользователями (удаление, создание, просмотр списка), но с помощью HTTP
т.е. будет 3 URL, например:

1. GET /list-users. выводит список пользователей
2. DELETE /delete-user/{id}. удаляет пользователя с переданным id
3. POST /create-user. создаёт пользователя с переданными данными. данные должны приниматься в формате JSON

Ответы должны быть в формате JSON.*/
