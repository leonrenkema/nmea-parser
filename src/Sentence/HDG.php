<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;

/**
 * HDG - Magnetic heading with deviation and variation.
 *
 * Contains magnetic sensor heading plus optional magnetic deviation and
 * variation values with east/west directions.
 *
 * @see https://w3.cs.jmu.edu/bernstdh/web/common/help/nmea-sentences.php
 */
class HDG extends BaseSentence
{
    public float $heading;

    public ?float $deviation;

    public ?Direction $deviationDirection;

    public ?float $variation;

    public ?Direction $variationDirection;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),'
        .'([^,]*),(E|W)?,'
        .'([^,]*),(E|W)?'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->heading = (float) $matches[2];
        $this->deviation = $matches[3] === '' ? null : (float) $matches[3];
        $this->deviationDirection = Direction::tryFrom($matches[4]);
        $this->variation = $matches[5] === '' ? null : (float) $matches[5];
        $this->variationDirection = Direction::tryFrom($matches[6]);
    }
}
