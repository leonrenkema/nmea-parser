<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * VLW - Distance traveled through water.
 *
 * Contains total nautical miles traveled and nautical miles traveled since the
 * last reset.
 *
 * @see https://w3.cs.jmu.edu/bernstdh/web/common/help/nmea-sentences.php
 */
class VLW extends BaseSentence
{
    public float $totalDistanceNauticalMiles;

    public float $distanceSinceResetNauticalMiles;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),N,'
        .'([0-9\.]*),N'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->totalDistanceNauticalMiles = (float) $matches[2];
        $this->distanceSinceResetNauticalMiles = (float) $matches[3];
    }
}
