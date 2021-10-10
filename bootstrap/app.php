<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    \dirname(__DIR__)
))->bootstrap();

\date_default_timezone_set(\env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(
    \dirname(__DIR__)
);

$app->withFacades();
$app->register(
    de\xovatec\linkify\Providers\AppServiceProvider::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    de\xovatec\linkify\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    de\xovatec\linkify\Console\Kernel::class
);

return $app;
