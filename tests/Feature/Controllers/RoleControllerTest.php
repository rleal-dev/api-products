<?php

use Domain\Role\Models\Role;
use Domain\User\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->resource = [
        'id',
        'name',
        'is_active',
        'created_at',
    ];
});

it('show the list of roles', function () {
    Role::factory(10)->create();

    $this->getJson('api/v1/roles')
        ->assertOk()
        ->assertJsonStructure([
            'data' =>  [
                '*' => $this->resource,
            ],
        ]);
});

it('store with missing data')
    ->postJson('api/v1/roles', [])
    ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
    ->assertJsonStructure([
        'message',
        'errors',
    ]);

it('role is created successfully', function () {
    $data = Role::factory()->raw();

    $this->postJson('api/v1/roles', $data)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => $this->resource,
        ]);
});

it('show the details of role', function () {
    $role = Role::factory()->create();

    $this->getJson('api/v1/roles/' . $role->id)
        ->assertOk()
        ->assertJsonStructure([
            'data' => $this->resource,
        ]);
});

it('show for missing role')
    ->getJson('api/v1/roles/0')
    ->assertStatus(Response::HTTP_NOT_FOUND)
    ->assertJsonStructure([
        'error',
    ]);

it('role is updated successfully', function () {
    $role = Role::factory()->create();
    $data = [
        'is_active' => false,
    ];

    $this->putJson('api/v1/roles/' . $role->id, $data)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('update for missing role')
    ->putJson('api/v1/roles/0', [])
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);

it('role is destroyed successfully', function () {
    $role = Role::factory()->create();

    $this->deleteJson('api/v1/roles/' . $role->id)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('destroy for missing role')
    ->deleteJson('api/v1/roles/0')
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);
