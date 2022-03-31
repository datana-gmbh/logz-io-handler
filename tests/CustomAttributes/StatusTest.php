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

namespace Datana\Intercom\Value\Tests\CustomAttributes;

use Datana\Intercom\Value\CustomAttributes\Status;
use PHPUnit\Framework\TestCase;

final class StatusTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider fromStringProvider
     */
    public function fromString(string $value, string $label): void
    {
        $status = Status::fromString($value);

        self::assertSame($value, $status->value());
        self::assertSame($label, $status->label());
    }

    /**
     * @return \Generator<string, array<string, string>>
     */
    public function fromStringProvider(): \Generator
    {
        $values = [
            'mandatiert' => 'Mandatiert',
            'aussergerichtlich' => 'Aussergerichtliches Verfahren',
            'klage' => 'Klage (1. Instanz)',
            'berufungsverfahren' => 'Berufungsverfahren',
            'abschluss_obsiegen' => 'Beendetes Verfahren - Obsiegen',
            'abschluss_unterliegen' => 'Beendetes Verfahren - Unterliegen',
            'abschluss_vergleich' => 'Beendetes Verfahren - Vergleich',
        ];

        foreach ($values as $status => $label) {
            yield $status => [$status, $label];
        }
    }
}
