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

namespace Datana\Intercom\Value\Helper;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class DateTimeHelper
{
    public static function createDateTimeFromUnixTimestamp(int $timestamp): \DateTime
    {
        $dateTime = new \DateTime('@'.$timestamp);
        $dateTime->setTimezone(new \DateTimeZone('Europe/Berlin'));

        return $dateTime;
    }
}
