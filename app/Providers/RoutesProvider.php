<?php

namespace de\xovatec\linkify\Providers;

use de\xovatec\linkify\Controllers\LinkController;
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

        $router->get('links', LinkController::class . '@list');
        $router->get('', LinkController::class . '@list');
        $router->post('link', LinkController::class . '@add');
        $router->post('link-read/{id}', LinkController::class . '@markAsRead');
    }

}
