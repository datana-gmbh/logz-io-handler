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

use Datana\Intercom\Value\CustomAttributes\Anrede;
use PHPUnit\Framework\TestCase;

final class AnredeTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider fromStringProvider
     */
    public function fromString(string $value): void
    {
        $anrede = Anrede::fromString($value);

        self::assertSame($value, $anrede->toString());
    }

    /**
     * @return \Generator<string, array<string>>
     */
    public function fromStringProvider(): \Generator
    {
        yield 'Herr' => ['Herr'];
        yield 'Frau' => ['Frau'];
    }
}
