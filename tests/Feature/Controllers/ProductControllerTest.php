<?php

use Domain\Product\Models\Product;
use Domain\User\Models\User;
use Illuminate\Http\Response;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->resource = [
        'id',
        'description',
        'category_id',
        'dimensions',
        'code',
        'reference',
        'quantity_stock',
        'price',
        'is_active',
        'created_at',
    ];
});

it('show the list of products', function () {
    Product::factory(10)->create();

    $this->getJson('api/v1/products')
        ->assertOk()
        ->assertJsonStructure([
            'data' =>  [
                '*' => $this->resource,
            ],
        ]);
});

it('store with missing data')
    ->postJson('api/v1/products', [])
    ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
    ->assertJsonStructure([
        'message',
        'errors',
    ]);

it('product is created successfully', function () {
    $data = Product::factory()->raw();

    $this->postJson('api/v1/products', $data)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => $this->resource,
        ]);
});

it('show the details of product', function () {
    $product = Product::factory()->create();

    $this->getJson('api/v1/products/' . $product->id)
        ->assertOk()
        ->assertJsonStructure([
            'data' => $this->resource,
        ]);
});

it('show for missing product')
    ->getJson('api/v1/products/0')
    ->assertStatus(Response::HTTP_NOT_FOUND)
    ->assertJsonStructure([
        'error',
    ]);

it('product is updated successfully', function () {
    $product = Product::factory()->create();
    $data = [
        'is_active' => false,
    ];

    $this->putJson('api/v1/products/' . $product->id, $data)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('update for missing product')
    ->putJson('api/v1/products/0', [])
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);

it('product is destroyed successfully', function () {
    $product = Product::factory()->create();

    $this->deleteJson('api/v1/products/' . $product->id)
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'message',
        ]);
});

it('destroy for missing product')
    ->deleteJson('api/v1/products/0')
    ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
    ->assertJsonStructure([
        'status',
        'message',
    ]);
