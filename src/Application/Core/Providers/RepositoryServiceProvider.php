<?php

namespace App\Core\Providers;

use Domain\User\{Contracts, Repositories};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private $binds = [
        Contracts\UserRepositoryInterface::class => Repositories\UserRepository::class,
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
