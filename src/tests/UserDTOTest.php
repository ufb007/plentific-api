<?php

use Ubozdemir\Plentific\DTOs\UserDTO;

it('test case for UserDTO', function () {
    $userDTO = new UserDTO(
        1,
        'Ufuk',
        'Bozdemir',
        'ufb007@gmail.com',
        'ufuk_bozdemir.jpg',
    );

    expect(json_encode($userDTO))->toEqual(json_encode([
        'id' => 1,
        'full_name' => 'Ufuk Bozdemir',
        'email' => 'ufb007@gmail.com',
        'avatar' => 'ufuk_bozdemir.jpg'
    ]));
});