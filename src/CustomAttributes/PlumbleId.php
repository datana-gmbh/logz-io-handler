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

namespace Datana\Intercom\Value\CustomAttributes;

use OskarStark\Value\TrimmedNonEmptyString;

final class PlumbleId
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = TrimmedNonEmptyString::fromString($value)->toString();
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
