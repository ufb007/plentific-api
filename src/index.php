<?php
require '../vendor/autoload.php';

use Ubozdemir\Plentific\Repositories\UserRepository;
use Ubozdemir\Plentific\Services\UserService;

$userRepository = new UserRepository();

$userService = new UserService($userRepository);

$users = $userService->all(2);

$user = $userService->getById(1);

if (isset($_POST['name'])) {
    $craetedUser = $userService->create($_POST);

    print_r($craetedUser);

    die();
}

echo '<pre>';
print_r($users);
print_r($user);