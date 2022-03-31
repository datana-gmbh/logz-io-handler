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

namespace Datana\Intercom\Value\App;

use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class InitializeRequest
{
    private array $value;

    private function __construct(array $value)
    {
        Assert::keyExists($value, 'workspace_id');

        $this->value = $value;
    }

    public static function fromJsonString(string $json): self
    {
        return new self(\Safe\json_decode($json, true));
    }

    public function fromConversation(): bool
    {
        return \array_key_exists('conversation_id', $this->value['context']);
    }

    public function conversationId(): ?int
    {
        if (!$this->fromConversation()) {
            return null;
        }

        return $this->value['context']['conversation_id'];
    }

    public function toArray(): array
    {
        return $this->value;
    }
}
