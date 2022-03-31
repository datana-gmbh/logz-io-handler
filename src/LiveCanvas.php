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

use Datana\Intercom\Value\Canvas\ContentUrl;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class LiveCanvas implements CanvasInterface
{
    private ContentUrl $contentUrl;

    private function __construct(ContentUrl $contentUrl)
    {
        $this->contentUrl = $contentUrl;
    }

    public static function fromValues(ContentUrl $contentUrl): self
    {
        return new self($contentUrl);
    }

    public function toArray(): array
    {
        return [
            'content_url' => $this->contentUrl->toString(),
        ];
    }
}
