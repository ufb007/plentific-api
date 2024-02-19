<?php
require '../vendor/autoload.php';

use Ubozdemir\Plentific\Repositories\UserRepository;
use Ubozdemir\Plentific\Services\UserService;

$userRepository = new UserRepository();

$userService = new UserService($userRepository);

$users = $userService->all(1);

$user = $userService->getById(5);

if (isset($_POST['name'])) {
    try {
        $craetedUser = $userService->create($_POST);

        print_r($craetedUser);

        die();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

echo '<pre>';
print_r($users);
print_r($user);