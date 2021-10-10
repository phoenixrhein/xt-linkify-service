<?php

namespace de\xovatec\linkify\Providers;

use de\xovatec\linkify\Controllers\UsersController;
use Laravel\Lumen\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RoutesProvider extends ServiceProvider
{
    /**
     * @param Router $router
     * @return void
     */
    public function boot(Router $router): void
    {
        //$router->resource('users', UsersController::class, Router::ALL);
        
        $router->get('', [
            'as' => 'list', 
            'uses' => UsersController::class.'@index'
        ]);

    }
}
