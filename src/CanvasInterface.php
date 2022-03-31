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

namespace Datana\Intercom\Value;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
interface CanvasInterface
{
    public function toArray(): array;
}
