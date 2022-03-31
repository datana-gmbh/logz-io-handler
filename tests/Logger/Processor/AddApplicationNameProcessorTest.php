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

namespace Datana\LogzIo\Handler\Tests\Logger\Processor;

use Datana\LogzIo\Handler\Logger\Processor\AddApplicationNameProcessor;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework\TestCase;

final class AddApplicationNameProcessorTest extends TestCase
{
    use Helper;

    /**
     * @test
     */
    public function isFinal(): void
    {
        self::assertClassIsFinal(AddApplicationNameProcessor::class);
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

        new AddApplicationNameProcessor($value);
    }

    /**
     * @test
     */
    public function invoke(): void
    {
        $applicationName = self::faker()->word();

        $processor = new AddApplicationNameProcessor($applicationName);

        self::assertSame(
            [
                'application' => $applicationName,
            ],
            $processor->__invoke([])
        );
    }
}
