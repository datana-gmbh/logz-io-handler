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

use Datana\Intercom\Value\Helper\DateTimeHelper;
use OskarStark\Value\TrimmedNonEmptyString;
use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class Conversation
{
    private const TYPE = 'conversation';

    /**
     * @var array<mixed>
     */
    private array $values;
    private string $id;
    private \DateTimeInterface $createdAt;

    /**
     * @param array<mixed> $values
     */
    private function __construct(array $values)
    {
        $this->values = $values;

        Assert::keyExists($values, 'type');
        Assert::same(self::TYPE, $values['type']);

        Assert::keyExists($values, 'id');
        $this->id = TrimmedNonEmptyString::fromString($values['id'])->toString();

        Assert::keyExists($values, 'created_at');
        Assert::integer($values['created_at']);
        $this->createdAt = DateTimeHelper::createDateTimeFromUnixTimestamp($values['created_at']);
    }

    public static function fromResponse(\stdClass $response): self
    {
        return new self(UnstructuredArray::fromStdClass($response)->value());
    }

    /**
     * @param array<mixed> $values
     */
    public static function fromArray(array $values): self
    {
        return new self($values);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function createdAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function contactId(): string
    {
        if ('customer_initiated' === $this->values['source']['delivered_as']) {
            return $this->values['source']['author']['id'];
        }

        if ('automated' === $this->values['source']['delivered_as']
            && [] !== $this->values['contacts']['contacts']
            && \array_key_exists(0, $this->values['contacts']['contacts'])
            && 'contact' === $this->values['contacts']['contacts'][0]['type']
        ) {
            return $this->values['contacts']['contacts'][0]['id'];
        }
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return $this->values;
    }
}
