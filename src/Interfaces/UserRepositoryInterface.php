<?php

namespace Ubozdemir\Plentific\Interfaces;

interface UserRepositoryInterface {
    public function getUsers();
    public function getUserById($id);
    public function createNewUser(array $data);
}