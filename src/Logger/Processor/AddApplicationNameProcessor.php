<?php

namespace Datana\LogzIo\Handler\Logger\Processor;

use OskarStark\Value\TrimmedNonEmptyString;

final class AddApplicationNameProcessor
{
    public function __construct(
        private readonly string $applicationName
    ) {
        TrimmedNonEmptyString::fromString($applicationName);
    }

    public function __invoke(array $record)
    {
        $record['application'] = $this->applicationName;

        return $record;
    }
}
