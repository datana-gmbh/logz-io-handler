<?php

declare(strict_types=1);

/**
 * This file is part of datana-gmbh/logz-io-handler.
 *
 * (c) Datana GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\LogzIo\Handler\Logger\Processor;

use OskarStark\Value\TrimmedNonEmptyString;

final class AddApplicationNameProcessor
{
    public function __construct(
        private readonly string $applicationName,
    ) {
        TrimmedNonEmptyString::fromString($applicationName);
    }

    public function __invoke(array $record)
    {
        $record['application'] = $this->applicationName;

        return $record;
    }
}
