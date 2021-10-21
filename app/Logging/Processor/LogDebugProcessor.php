<?php

namespace de\xovatec\linkify\Logging\Processor;

use Monolog\Processor\ProcessorInterface;

class LogDebugProcessor implements ProcessorInterface
{
    private string $uuid;

    /**
     * LogDebugProcessor constructor.
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        $record['extra']['uuid'] = $this->uuid;

        return $record;
    }
}