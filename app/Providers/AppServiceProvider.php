<?php

namespace App\Providers;

use App\Http\View\Composers\Mensaje;
use App\Http\View\Composers\Notificaciones;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        // Asocia el Composer a un grupo de vistas o layouts
        View::composer('layouts.navigation-header', Mensaje::class); 
        View::composer('layouts.navigation-header', Notificaciones::class);
    }
}
