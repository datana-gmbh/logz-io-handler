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
use function Symfony\Component\String\u;

final class Status
{
    private string $value;

    private function __construct(string $value)
    {
        $value = trim($value);

        Assert::oneOf(
            $value,
            [
                'mandatiert',
                'aussergerichtlich',
                'klage',
                'berufungsverfahren',
                'abschluss_obsiegen',
                'abschluss_unterliegen',
                'abschluss_vergleich',
            ]
        );

        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function label(): string
    {
        if (\in_array($this->value, [
            'mandatiert',
            'berufungsverfahren',
        ], true)) {
            return u($this->value)->title()->toString();
        }

        if ('aussergerichtlich' === $this->value) {
            return 'Aussergerichtliches Verfahren';
        }

        if ('klage' === $this->value) {
            return 'Klage (1. Instanz)';
        }

        if ('abschluss_obsiegen' === $this->value) {
            return 'Beendetes Verfahren - Obsiegen';
        }

        if ('abschluss_unterliegen' === $this->value) {
            return 'Beendetes Verfahren - Unterliegen';
        }

        if ('abschluss_vergleich' === $this->value) {
            return 'Beendetes Verfahren - Vergleich';
        }

        return $this->value;
    }
}
