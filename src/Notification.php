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

use Datana\Intercom\Value\Workspace\AppId;
use OskarStark\Value\TrimmedNonEmptyString;
use Safe\DateTimeImmutable;
use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 *
 * @see https://developers.intercom.com/building-apps/docs/webhook-model#section-webhook-notification-object
 *
 * Example payload:
 * {
 *   "type": "notification_event",
 *   "topic": "company.created",
 *   "id": "notif_ccd8a4d0-f965-11e3-a367-c779cae3e1b3",
 *   "app_id" : "a86dr8yl",
 *   "created_at": 1392731331,
 *   "delivery_attempts": 1,
 *   "first_sent_at": 1392731392,
 *   "data": {
 *     "item": {
 *       "type": "company",
 *       "id": "531ee472cce572a6ec000006",
 *       "name": "Blue Sun",
 *       "company_id": "6",
 *       "remote_created_at": 1394531169,
 *       "created_at": 1394533506,
 *       "updated_at": 1396874658,
 *       "custom_attributes": {
 *       }
 *     }
 *   }
 * }
 */
final class Notification
{
    private array $value;

    private string $type;
    private string $topic;
    private string $id;
    private AppId $appId;
    private \Safe\DateTimeImmutable $createdAt;
    private int $deliveryAttempts;
    private array $data;

    private function __construct(array $value)
    {
        $this->value = $value;

        Assert::keyExists($value, 'type');
        $this->type = TrimmedNonEmptyString::fromString($value['type'])->toString();

        Assert::keyExists($value, 'topic');
        $this->topic = TrimmedNonEmptyString::fromString($value['topic'])->toString();

        Assert::keyExists($value, 'id');
        $this->id = TrimmedNonEmptyString::fromString($value['id'])->toString();

        Assert::keyExists($value, 'app_id');
        $this->appId = AppId::fromString($value['app_id']);

        Assert::keyExists($value, 'created_at');
        $this->createdAt = \Safe\DateTimeImmutable::createFromFormat('u', $value['created_at']);

        Assert::keyExists($value, 'delivery_attempts');
        $this->deliveryAttempts = $value['delivery_attempts'];

        Assert::keyExists($value, 'first_sent_at');
        $this->firstSentAt = \Safe\DateTimeImmutable::createFromFormat('u', $value['first_sent_at']);

        Assert::keyExists($value, 'data');
        $this->data = $value['data'];
    }

    public static function fromJsonString(string $json): self
    {
        return new self(\Safe\json_decode($json, true));
    }

    public function type(): string
    {
        return $this->type;
    }

    public function topic(): string
    {
        return $this->topic;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function appId(): AppId
    {
        return $this->appId;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function deliveryAttempts(): int
    {
        return $this->deliveryAttempts;
    }

    public function firstSentAt(): DateTimeImmutable
    {
        return $this->firstSentAt;
    }

    public function data(): DateTimeImmutable
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return $this->value;
    }
}
