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

namespace Datana\Intercom\Value\Canvas;

use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class Component
{
    private array $value;

    private function __construct(array $value)
    {
        Assert::notEmpty($value);

        $this->value = $value;
    }

    public static function Text(string $text, ?string $style = null): self
    {
        $value = [
            'text' => $text,
            'type' => 'text',
        ];

        if (null !== $style) {
            $value['style'] = $style;
        }

        return new self($value);
    }

    public static function Header(string $text): self
    {
        return self::Text($text, 'header');
    }

    public static function Divider(): self
    {
        return new self([
            'type' => 'divider',
        ]);
    }

    public static function Link(string $url, string $label): self
    {
        return new self([
            'type' => 'text',
            'text' => sprintf('[%s](%s)', $label, $url),
            'align' => 'center',
        ]);
    }

    public function toArray(): array
    {
        return $this->value;
    }
}
