<?php

use Domain\Category\Models\Category;
use Domain\User\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->resource = [
        'id',
        'description',
        'is_active',
        'created_at',
    ];
});

it('show the list of categories', function () {
    Category::factory(10)->create();

    $this->getJson('api/v1/categories')
        ->assertOk()
        ->assertJsonStructure([
            'data' =>  [
                '*' => $this->resource,
            ],
        ]);
});

it('store with missing data')
    ->postJson('api/v1/categories', [])
    ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
    ->assertJsonStructure([
        'message',
        'errors',
    ]);

it('category is created successfully', function () {
    $data = Category::factory()->raw();

    $this->postJson('api/v1/categories', $data)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => $this->resource,
        ]);
});

it('show the details of category', function () {
    $category = Category::factory()->create();

    $this->getJson('api/v1/categories/' . $category->id)
        ->assertOk()
        ->assertJsonStructure([
            'data' => $this->resource,
        ]);
});

it('show for missing category')
    ->getJson('api/v1/categories/0')
    ->assertStatus(Response::HTTP_NOT_FOUND)
    ->assertJsonStructure([
        'error',
    ]);

it('category is updated successfully', function () {
    $category = Category::factory()->create();
    $data = [
        'is_active' => false,
    ];

    $this->putJson('api/v1/categories/' . $category->id, $data)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('update for missing category')
    ->putJson('api/v1/categories/0', [])
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);

it('category is destroyed successfully', function () {
    $category = Category::factory()->create();

    $this->deleteJson('api/v1/categories/' . $category->id)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('destroy for missing category')
    ->deleteJson('api/v1/categories/0')
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);
