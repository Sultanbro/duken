<?php

namespace App\Providers;

use App\Services\Basket\BasketService;
use App\Services\Basket\BasketServiceInterface;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use App\Services\File\FileService;
use App\Services\File\FileServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            CategoryServiceInterface::class,
            CategoryService::class
        );
        $this->app->bind(
            ProductServiceInterface::class,
            ProductService::class
        );
        $this->app->bind(
            BasketServiceInterface::class,
            BasketService::class
        );
        $this->app->bind(
            FileServiceInterface::class,
            FileService::class
        );
    }
}
