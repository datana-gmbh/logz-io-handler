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
final class UnstructuredArray
{
    private array $value;

    private function __construct(array $value)
    {
        $this->value = $value;
    }

    public static function fromStdClass(\stdClass $value): self
    {
        return new self(\Safe\json_decode(\Safe\json_encode($value), true));
    }

    public function value(): array
    {
        return $this->value;
    }
}
