<?php

use Domain\Role\Models\Role;

beforeEach(function () {
    $this->role = Role::factory()->create();
});

it('roles has expected columns', function () {
    $columns = (new Role)->getFillable();

    $this->assertTrue(Schema::hasColumns('roles', $columns), 1);
});

it('role is instance of Role', function () {
    $this->assertInstanceOf(Role::class, $this->role);
});
