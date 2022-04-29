<?php

use Domain\Category\Models\Category;

beforeEach(function () {
    $this->category = Category::factory()->create();
});

it('categories has expected columns', function () {
    $columns = (new Category)->getFillable();

    $this->assertTrue(Schema::hasColumns('categories', $columns), 1);
});

it('category is instance of Category', function () {
    $this->assertInstanceOf(Category::class, $this->category);
});
