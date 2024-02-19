<?php

namespace Ubozdemir\Plentific\Repositories;

use Exception;
use GuzzleHttp\Client;
use Ubozdemir\Plentific\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Constructor for the class.
     *
     * @param Client $client
     */
    public function __construct(
        protected Client $client = new Client([ 'base_uri' => 'https://reqres.in/api/' ])
    ) {}

    /**
     * A description of the entire PHP function.
     *
     * @param int $page description
     * @throws Exception description of exception
     * @return array
     */
    public function getUsers(int $page = 1)
    {
        try {
            $response = $this->client->request('GET', "users?page=$page");

            $body = $response->getBody()->getContents();

            $data = json_decode($body, true);

            return $data['data'];
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieves user data by ID.
     *
     * @param int $id The ID of the user to retrieve
     * @throws Exception description of exception
     * @return array The user data
     */
    public function getUserById($id) {
        try {
            $response = $this->client->get("users/$id");

            $body = $response->getBody()->getContents();

            $data = json_decode($body, true);

            return $data['data'];
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Creates a new user with the given data.
     *
     * @param array $data The user data to be used for creating the new user.
     * @throws Exception description of exception
     * @return int The ID of the newly created user.
     */
    public function createNewUser(array $data) 
    {
        try {
            $response = $this->client->post('users', ['json' => $data]);

            $body = $response->getBody()->getContents();

            ['id' => $id] = json_decode($body, true);

            return $id;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}