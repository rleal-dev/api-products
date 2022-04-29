<?php

use Domain\User\Models\User;
use Illuminate\Http\Response;
use function Pest\Faker\faker;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->resource = [
        'id',
        'name',
        'email',
        'is_active',
        'created_at',
    ];
});

it('show the list of users', function () {
    User::factory(10)->create();

    $this->getJson('api/v1/users')
        ->assertOk()
        ->assertJsonStructure([
            'data' =>  [
                '*' => $this->resource,
            ],
        ]);
});

it('store with missing data')
    ->postJson('api/v1/users', [])
    ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
    ->assertJsonStructure([
        'message',
        'errors',
    ]);

it('user is created successfully', function () {
    $data = [
        'name' => faker()->name,
        'email' => faker()->unique()->safeEmail(),
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ];

    $this->postJson('api/v1/users', $data)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => $this->resource,
        ]);
});

it('show the details of user', function () {
    $user = User::factory()->create();

    $this->getJson('api/v1/users/' . $user->id)
        ->assertOk()
        ->assertJsonStructure([
            'data' => $this->resource,
        ]);
});

it('show for missing user')
    ->getJson('api/v1/users/0')
    ->assertStatus(Response::HTTP_NOT_FOUND)
    ->assertJsonStructure([
        'error',
    ]);

it('user is updated successfully', function () {
    $user = User::factory()->create();
    $data = [
        'is_active' => false,
    ];

    $this->putJson('api/v1/users/' . $user->id, $data)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('update for missing user')
    ->putJson('api/v1/users/0', [])
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);

it('user is destroyed successfully', function () {
    $user = User::factory()->create();

    $this->deleteJson('api/v1/users/' . $user->id)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('destroy for missing user')
    ->deleteJson('api/v1/users/0')
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);
