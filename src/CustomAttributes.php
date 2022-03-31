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

use Datana\Intercom\Value\CustomAttributes\Anrede;
use Datana\Intercom\Value\CustomAttributes\PlumbleId;
use Datana\Intercom\Value\CustomAttributes\Status;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class CustomAttributes
{
    private array $value;

    private function __construct(array $value)
    {
        $this->value = $value;
    }

    public static function fromArray(array $value): self
    {
        return new self($value);
    }

    public function Aktenzeichen(): ?string
    {
        return $this->getTrimmedKey('Aktenzeichen');
    }

    public function Anrede(): ?Anrede
    {
        if (null !== $value = $this->getTrimmedKey('Anrede')) {
            return Anrede::fromString($value);
        }

        return null;
    }

    public function Titel(): ?string
    {
        return $this->getTrimmedKey('Titel');
    }

    public function Venture(): ?string
    {
        return $this->getTrimmedKey('Venture');
    }

    public function Produkt(): ?string
    {
        return $this->getTrimmedKey('Produkt');
    }

    public function PlumbleId(): ?PlumbleId
    {
        if (null !== $value = $this->getTrimmedKey('PlumbleId')) {
            return PlumbleId::fromString($value);
        }

        return null;
    }

    public function Status(): ?Status
    {
        if (null !== $value = $this->getTrimmedKey('Status')) {
            return Status::fromString($value);
        }

        return null;
    }

    public function toArray(): array
    {
        return $this->value;
    }

    private function getTrimmedKey(string $key): ?string
    {
        if (\array_key_exists($key, $this->value)
            && '' !== trim($this->value[$key])
        ) {
            return trim($this->value[$key]);
        }

        return null;
    }
}
