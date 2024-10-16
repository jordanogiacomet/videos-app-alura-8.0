<?php

namespace App\Providers;

use App\Http\Repositories\VideoRepository;
use App\Models\Video;
use Illuminate\Support\ServiceProvider;
use App\Services\VideoService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VideoService::class, function ($app) {
            return new VideoService(new VideoRepository());
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
