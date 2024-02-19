<?php

namespace Ubozdemir\Plentific\Services;

use Ubozdemir\Plentific\Repositories\UserRepository;
use Ubozdemir\Plentific\DTOs\UserDTO;
use Rakit\Validation\Validator;

class UserService {
    public function __construct(protected UserRepository $userRepository) {}

    /**
     * Retrieve all users with optional pagination.
     *
     * @param int $page the page number for pagination
     * @return array array of user DTOs
     */
    public function all(int $page = 1): array
    {
        $users = $this->userRepository->getUsers($page);

        $usersDTO = array_map(function($user) {
            return $this->formatUserDTO($user);
        }, $users);

        return $usersDTO;
    }

    /**
     * Get a user by their ID.
     *
     * @param int $id The ID of the user to retrieve.
     * @return UserDTO The user data transfer object.
     */
    public function getById(int $id)
    {
        $user = $this->userRepository->getUserById($id);

        return $this->formatUserDTO($user);
    }

    /**
     * A description of the entire PHP function.
     *
     * @param array $data 
     * @throws \Exception description of exception
     * @return Some_Return_Value
     */
    public function create(array $data) 
    {
        try {
            $validator = new Validator();

            $validation = $validator->make($data, [
                'name' => 'required',
                'job' => 'required'
            ]);

            $validation->validate();

            if ($validation->fails()) {
                throw new \Exception($validation->errors()->firstOfAll()[0]);
            }

            return $this->userRepository->createNewUser($data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Format user data transfer object
     *
     * @param array $user 
     * @return string
     */
    protected function formatUserDTO(array $user) {
        [
            'id' => $id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'avatar' => $avatar
        ] = $user;

        return json_encode(new UserDTO($id, $firstName, $lastName, $email, $avatar));
    }
}