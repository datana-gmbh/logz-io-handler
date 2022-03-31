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

use OskarStark\Value\TrimmedNonEmptyString;
use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class Contact
{
    private const TYPE = 'contact';

    /**
     * @var array<mixed>
     */
    private array $values;
    private string $id;
    private string $externalId;
    private CustomAttributes $customAttributes;

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

        Assert::keyExists($values, 'external_id');
        $this->externalId = TrimmedNonEmptyString::fromString($values['external_id'])->toString();

        $this->customAttributes = CustomAttributes::fromArray($values['custom_attributes']);
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

    public function externalId(): string
    {
        return $this->externalId;
    }

    public function customAttributes(): CustomAttributes
    {
        return $this->customAttributes;
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return $this->values;
    }
}
