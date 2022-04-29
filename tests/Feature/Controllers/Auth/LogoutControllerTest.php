<?php

use Domain\User\Models\User;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('logout user successfully and delete all tokens')
    ->deleteJson('api/v1/logout', ['logout_mode' => 'ALL_TOKENS'])
    ->assertOk()
    ->assertJsonStructure([
        'status',
        'message',
    ]);

it('logout user successfully and delete current token')
    ->deleteJson('api/v1/logout', ['logout_mode' => 'CURRENT_TOKEN'])
    ->assertOk()
    ->assertJsonStructure([
        'status',
        'message',
    ]);
