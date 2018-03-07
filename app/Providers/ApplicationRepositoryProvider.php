<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ApplicationRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('displaymoney', function($expression)
        {
           return "<?php echo (!empty($expression) ? '£' . number_format($expression, 2) : 'N/A') ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Users\IUserRepository', 'App\Repositories\Users\UserRepository');
        $this->app->bind('App\Repositories\Roles\IRoleRepository', 'App\Repositories\Roles\RoleRepository');
        $this->app->bind('App\Repositories\Permissions\IPermissionRepository', 'App\Repositories\Permissions\PermissionRepository');
    }
}
