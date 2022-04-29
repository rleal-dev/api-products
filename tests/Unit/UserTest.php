<?php

use Domain\User\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('users has expected columns', function () {
    $columns = (new User)->getFillable();

    $this->assertTrue(Schema::hasColumns('users', $columns), 1);
});

it('user is instance of User', function () {
    $this->assertInstanceOf(User::class, $this->user);
});
