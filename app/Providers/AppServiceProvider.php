<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\Kreait\Firebase\Database::class, function ($app) {
            $firebase = (new Factory)
                ->withServiceAccount(env('FIREBASE_CREDENTIALS'))
                ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
    
            return $firebase->createDatabase();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
