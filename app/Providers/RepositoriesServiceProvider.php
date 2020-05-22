<?php

namespace App\Providers;

use App\Repositories\TodoRepository;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);
    }
}
