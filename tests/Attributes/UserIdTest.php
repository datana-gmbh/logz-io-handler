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

namespace Datana\Intercom\Value\Tests\Attributes;

use Datana\Intercom\Value\Attributes;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework\TestCase;

final class UserIdTest extends TestCase
{
    use Helper;

    /**
     * @test
     */
    public function isFinal(): void
    {
        self::assertClassIsFinal(Attributes\UserId::class);
    }

    /**
     * @test
     *
     * @dataProvider \Ergebnis\Test\Util\DataProvider\StringProvider::blank()
     * @dataProvider \Ergebnis\Test\Util\DataProvider\StringProvider::empty()
     */
    public function throwsExcetionIfValueIs(string $value): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Attributes\UserId::fromString($value);
    }

    /**
     * @test
     */
    public function toStringReturnsValueFromFromString(): void
    {
        $value = self::faker()->uuid;

        $userId = Attributes\UserId::fromString($value);

        self::assertSame(
            $value,
            $userId->toString()
        );
    }
}
