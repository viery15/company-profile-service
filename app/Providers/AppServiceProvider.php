<?php

namespace App\Providers;

use App\Domain\Catalog\Repositories\CatalogRepository;
use App\Domain\Category\Repositories\CategoryRepository;
use App\Domain\Configuration\Repositories\ConfigurationRepository;
use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;
use App\Domain\User\Repositories\UserRepository;
use App\Infrastructure\Category\Repositories\CategoryEloquentRepository;
use App\Infrastructure\Configuration\Repositories\ConfigurationEloquentRepository;
use App\Infrastructure\Post\Repositories\PostEloquentRepository;
use App\Infrastructure\User\Repositories\UserEloquentRepository;
use App\Domain\User\Entities\User;
use App\Domain\Category\Entities\Category;
use App\Domain\Configuration\Entities\Configuration;
use App\Domain\File\Entities\File;
use App\Infrastructure\File\Repositories\FileEloquentRepository;
use App\Domain\File\Repositories\FileRepository;
use App\Domain\User\Repositories\UserPostPermissionRepository;
use App\Infrastructure\Catalog\Repositories\CatalogEloquentRepository;
use App\Infrastructure\User\Repositories\UserPostPermissionEloquentRepository;
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
            return new CategoryEloquentRepository(new Category());
        });
        $this->app->bind(ConfigurationRepository::class, function () {
            return new ConfigurationEloquentRepository(new Configuration());
        });
        $this->app->bind(FileRepository::class, function () {
            return new FileEloquentRepository(new File());
        });
        $this->app->bind(CatalogRepository::class, function () {
            return new CatalogEloquentRepository(new File());
        });
        $this->app->bind(UserPostPermissionRepository::class, function () {
            return new UserPostPermissionEloquentRepository(new File());
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
