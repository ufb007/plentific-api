<?php

use Ubozdemir\Plentific\Repositories\UserRepository;
use Ubozdemir\Plentific\Services\UserService;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

it('test case for UserService get users', function () {
    $userData = [
        [
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'ufb007@gmail.com',
            'avatar' => 'ufuk_bozdemir.jpg',
        ],
        [
            'id' => 2,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'avatar' => 'jane_avatar.jpg',
        ]
    ];

    $mock = new MockHandler([
        new Response(200, [], json_encode(['data' => $userData])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new GuzzleClient(['handler' => $handlerStack]);

    $userRepository = new UserRepository($client);
    $userService = new UserService($userRepository);

    $users = $userService->all();
    
    expect($users)->toBeArray()->and(json_decode($users[0]))->toMatchArray([
        'full_name' => 'John Doe',
        'email' => 'ufb007@gmail.com',
        'avatar' => 'ufuk_bozdemir.jpg',
    ]);
});

it('test case for UserService get user by ID', function () {
    $userData = [
        'id' => 1,
        'first_name' => 'Ufuk',
        'last_name' => 'Bozdemir',
        'email' => 'ufb007@gmail.com',
        'avatar' => 'ufuk_bozdemir.jpg',
    ];

    $mock = new MockHandler(([
        new Response(200, [], json_encode(['data' => $userData])),
    ]));

    $handlerStack = HandlerStack::create($mock);
    $client = new GuzzleClient(['handler' => $handlerStack]);

    $userRepository = new UserRepository($client);
    $userService = new UserService($userRepository);

    $user = $userService->getById(1);

    expect($user)->toEqual(json_encode([
        'id' => 1,
        'full_name' => 'Ufuk Bozdemir',
        'email' => 'ufb007@gmail.com',
        'avatar' => 'ufuk_bozdemir.jpg',
    ]));
});

it('test case for UserService create new user', function () {
    $userData = ['name' => 'Mehmet Bozdemir', 'job' => 'developer'];

    $mock = new MockHandler([
        new Response(201, [], json_encode(['id' => 3])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new GuzzleClient(['handler' => $handlerStack]);

    $userRepository = new UserRepository($client);
    $userService = new UserService($userRepository);

    $createdUserId = $userService->create($userData);

    expect($createdUserId)->toBeInt()->and($createdUserId)->toEqual(3);
});
