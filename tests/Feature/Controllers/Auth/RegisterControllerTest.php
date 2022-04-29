<?php

use Illuminate\Http\Response;
use function Pest\Faker\faker;

it('register user successfully', function () {
    $data = [
        'name' => faker()->name,
        'email' => faker()->unique()->safeEmail(),
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ];

    $this->postJson('api/v1/register', $data)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'access_token',
            ],
        ]);

    $this->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
});
