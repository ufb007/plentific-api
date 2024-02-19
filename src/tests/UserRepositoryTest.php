<?php

use Ubozdemir\Plentific\Repositories\UserRepository;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

it('can get user data with a mocked Guzzle client', function () {
    $mock = new MockHandler([
        new Response(200, [], json_encode(['data' => [['id' => 1, 'name' => 'Ufuk Bozdemir']]])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new GuzzleClient(['handler' => $handlerStack]);

    $userRepository = new UserRepository($client);
    $users = $userRepository->getUsers();

    expect($users)->toBeArray()->and($users[0])->toMatchArray(['id' => 1, 'name' => 'Ufuk Bozdemir']);
});

it('can get a single user data by ID with a mocked Guzzle client', function () {
    $mock = new MockHandler([
        new Response(200, [], json_encode(['data' => ['id' => 2, 'name' => 'Ufuk Bozdemir']])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new GuzzleClient(['handler' => $handlerStack]);

    $userRepository = new UserRepository($client);
    $user = $userRepository->getUserById(2);

    expect($user)->toBeArray()->and($user)->toMatchArray(['id' => 2, 'name' => 'Ufuk Bozdemir']);
});

it('can create a new user with a mocked Guzzle client', function () {
    $userData = ['name' => 'Mehmet Bozdemir', 'job' => 'developer'];

    $mock = new MockHandler([
        new Response(201, [], json_encode(['id' => 3])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new GuzzleClient(['handler' => $handlerStack]);

    $userRepository = new UserRepository($client);
    $createdUserId = $userRepository->createNewUser($userData);

    expect($createdUserId)->toBeInt()->and($createdUserId)->toEqual(3);
});
