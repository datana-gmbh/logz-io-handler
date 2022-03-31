<?php

declare(strict_types=1);

/**
 * This file is part of datana-gmbh/intercom-value-objects.
 *
 * (c) Datana GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\Intercom\Value\Tests\Helper;

use Datana\Intercom\Value\Helper\DateTimeHelper;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework\TestCase;

final class DateTimeHelperTest extends TestCase
{
    use Helper;

    /**
     * @test
     */
    public function createDateTimeFromUnixTimestamp(): void
    {
        self::assertSame(
            '2021-11-11 09:30:45',
            DateTimeHelper::createDateTimeFromUnixTimestamp(1636619445)->format('Y-m-d H:i:s')
        );
    }
}
