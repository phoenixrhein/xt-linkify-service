<?php

namespace de\xovatec\linkify\Logging;

use de\xovatec\linkify\Logging\Processor\ExecutionTimeProcessor;
use de\xovatec\linkify\Logging\Processor\LogDebugProcessor;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\ProcessIdProcessor;




class Interceptor
{
    protected string $name;

    /**
     * Interceptor constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->name = (string)$request->server->get('X-DEBUG-ID', '');
    }

    /**
     * @param Logger $logger
     * @return void
     */
    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getLogger()->getHandlers() as $handler) {
            $handler->pushProcessor(new ProcessIdProcessor());
            $handler->pushProcessor(new IntrospectionProcessor());
            $handler->pushProcessor(new ExecutionTimeProcessor());
            $handler->pushProcessor(new LogDebugProcessor($this->name));
        }
    }
}

