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

namespace Datana\Intercom\Value\Request;

use OskarStark\Value\TrimmedNonEmptyString;
use Symfony\Component\HttpFoundation\Request;
use Webmozart\Assert\Assert;

final class WebhookRequest
{
    private string $conversationId;
    private string $contactId;
    private string $topic;
    private string $type;

    /**
     * @param array<mixed> $values
     */
    private function __construct(array $values)
    {
        Assert::keyExists($values, 'data');

        Assert::keyExists($values['data'], 'item');

        Assert::keyExists($values['data']['item'], 'id');
        $this->conversationId = TrimmedNonEmptyString::fromString($values['data']['item']['id'])->toString();

        Assert::keyExists($values['data']['item'], 'user');
        Assert::keyExists($values['data']['item']['user'], 'id');
        $this->contactId = TrimmedNonEmptyString::fromString($values['data']['item']['user']['id'])->toString();

        Assert::keyExists($values, 'topic');
        $this->topic = TrimmedNonEmptyString::fromString($values['topic'])->toString();

        Assert::keyExists($values['data']['item'], 'type');
        $this->type = TrimmedNonEmptyString::fromString($values['data']['item']['type'])->toString();
    }

    public static function fromRequest(Request $request): self
    {
        return new self($request->toArray());
    }

    public function conversationId(): string
    {
        return $this->conversationId;
    }

    public function contactId(): string
    {
        return $this->contactId;
    }

    public function topic(): string
    {
        return $this->topic;
    }

    public function type(): string
    {
        return $this->type;
    }
}
