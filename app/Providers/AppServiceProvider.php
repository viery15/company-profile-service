<?php

namespace App\Providers;

use App\Domain\Category\Repositories\CategoryRepository;
use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;
use App\Domain\User\Repositories\UserRepository;
use App\Infrastructure\Category\Repositories\CategoryEloquentRepository;
use App\Infrastructure\Post\Repositories\PostEloquentRepository;
use App\Infrastructure\User\Repositories\UserEloquentRepository;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, function () {
            return new UserEloquentRepository(new User());
        });
        $this->app->bind(PostRepository::class, function () {
            return new PostEloquentRepository(new Post());
        });
        $this->app->bind(CategoryRepository::class, function () {
            return new CategoryEloquentRepository(new Post());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
