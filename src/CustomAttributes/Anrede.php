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

use Webmozart\Assert\Assert;

final class Anrede
{
    private string $value;

    private function __construct(string $value)
    {
        $value = trim($value);

        Assert::oneOf(
            $value,
            [
                'Herr',
                'Frau',
            ]
        );

        $this->value = $value;
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
