<?php

declare(strict_types=1);

/**
 * This file is part of datana-gmbh/logz-io-handler.
 *
 * (c) Datana GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\LogzIo\Handler\Tests\Logger\Processor;

use Datana\LogzIo\Handler\Logger\Processor\AddApplicationNameProcessor;
use Ergebnis\Test\Util\Helper;
use Monolog\Level;
use Monolog\LogRecord;
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
    public function invokeWithArray(): void
    {
        $applicationName = self::faker()->word();

        $processor = new AddApplicationNameProcessor($applicationName);

        self::assertSame(
            [
                'application' => $applicationName,
            ],
            $processor->__invoke([]),
        );
    }

    /**
     * @test
     */
    public function invokeWithLogRecord(): void
    {
        if (!class_exists(LogRecord::class)) {
            self::markTestSkipped(sprintf('Class "%s" not found.', LogRecord::class));
        }

        $applicationName = self::faker()->word();

        $processor = new AddApplicationNameProcessor($applicationName);

        $logRecord = new LogRecord(
            new \DateTimeImmutable(),
            self::faker()->word(),
            Level::Debug,
            self::faker()->sentence(),
        );

        self::assertSame(
            [
                'application' => $applicationName,
            ],
            $processor->__invoke($logRecord)['extra'],
        );
    }
}
