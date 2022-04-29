<?php

use Domain\User\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('login authenticates successfully', function () {
    $data = [
        'email' => $this->user->email,
        'password' => 'password',
    ];

    $this->postJson('api/v1/login', $data)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'access_token',
            ],
        ]);
});

it('login with invalid user', function () {
    $data = [
        'email' => $this->user->email,
        'password' => 'invalid-password',
    ];

    $this->postJson('api/v1/login', $data)
        ->assertStatus(Response::HTTP_UNAUTHORIZED)
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});
