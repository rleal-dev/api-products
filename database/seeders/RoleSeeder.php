<?php

namespace Database\Seeders;

use Domain\Role\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect([
            ['name' => 'ROLE_GET'],
            ['name' => 'ROLE_POST'],
            ['name' => 'ROLE_PATCH'],
            ['name' => 'ROLE_PUT'],
            ['name' => 'ROLE_DELETE'],
        ]);

        $roles->each(fn ($role) => Role::create($role));
    }
}
