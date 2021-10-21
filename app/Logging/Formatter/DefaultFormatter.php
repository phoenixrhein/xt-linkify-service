<?php

namespace de\xovatec\linkify\Logging\Formatter;

use Monolog\Formatter\LineFormatter;

class DefaultFormatter extends LineFormatter
{

    public const SIMPLE_DATE = \DATE_ATOM;
    
    public const SIMPLE_FORMAT = "%datetime% [%channel%-%extra.uuid%] [%extra.execution_time%s] [%extra.process_id%] " .
            "[%level_name%] [%extra.class%::%extra.function%] %message% %context% \n";

}
