<?php

namespace App\Core\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private $binds = [
        \Domain\User\Contracts\UserRepositoryInterface::class => \Domain\User\Repositories\UserRepository::class,
        \Domain\Role\Contracts\RoleRepositoryInterface::class => \Domain\Role\Repositories\RoleRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->binds as $interface => $class) {
            $this->app->bind($interface, $class);
        }
    }
}
