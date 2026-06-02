<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * HDT - Heading, true.
 *
 * Contains vessel heading referenced to true north.
 *
 * @see https://w3.cs.jmu.edu/bernstdh/web/common/help/nmea-sentences.php
 */
class HDT extends BaseSentence
{
    public float $heading;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),T'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->heading = (float) $matches[2];
    }
}
