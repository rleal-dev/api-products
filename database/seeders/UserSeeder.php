<?php

namespace Database\Seeders;

use Domain\Role\Models\Role;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect([
            [
                'name'     => 'User Teste',
                'email'    => 'user@email.com',
                'password' => '12345678',
            ],
        ]);

        $roles = Role::all();

        $users->each(function ($user) use ($roles) {
            $newUser = User::create($user);
            $newUser->roles()->attach($roles);
        });
    }
}
