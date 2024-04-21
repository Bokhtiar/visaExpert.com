<?php

namespace App\Providers;

use App\Models\Permission;
use App\Services\NotificationService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
     *
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Custom blade directive for role check
        Blade::if('role', function ($role) {
            return Auth::user()->role->slug == $role;
        });

        // Custom blade directive for permission check
        //        Blade::if('permission', function ($slug) {
        //            return Auth::user()->hasPermission($slug) == $slug;
        //        });

        View::composer('*', function ($view) {
            $notificationService = app(NotificationService::class);
            $notifications = $notificationService->getAllNotifications();
            $view->with('notifications', $notifications);
        });
    }
}
