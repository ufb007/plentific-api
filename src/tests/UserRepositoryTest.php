<?php

use Ubozdemir\Plentific\Repositories\UserRepository;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Pest\TestSuite;

it('fetch data from UserRpository', function() {
    TestSuite::(GuzzleClient::class, ['get' => new Response(200, [], '{"data": "mocked data"}')]);

    $userRepository = new UserRepository(new GuzzleClient());

    $data = $userRepository->getUsers();

    expect($data)->toEqual('{"data": "mocked data"}');
});