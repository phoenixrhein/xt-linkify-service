<?php

namespace de\xovatec\linkify\Logging\Processor;

use Monolog\Processor\ProcessorInterface;


class ExecutionTimeProcessor implements ProcessorInterface
{
    /**
     * @var float
     */
    private static $startTime = 0.0;

    public function __construct()
    {
        self::$startTime = \microtime(true);
    }

    /**
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        $record['extra']['execution_time'] = \round(\microtime(true) - self::$startTime, 4);

        return $record;
    }
}