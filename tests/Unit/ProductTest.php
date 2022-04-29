<?php

use Domain\Product\Models\Product;

beforeEach(function () {
    $this->product = Product::factory()->create();
});

it('products has expected columns', function () {
    $columns = (new Product)->getFillable();

    $this->assertTrue(Schema::hasColumns('products', $columns), 1);
});

it('product is instance of Product', function () {
    $this->assertInstanceOf(Product::class, $this->product);
});
