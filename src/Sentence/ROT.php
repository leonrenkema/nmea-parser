<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\FixStatus;

/**
 * ROT - Rate of turn.
 *
 * Contains vessel rate of turn and status, typically reported by heading or
 * rate gyro equipment.
 *
 * @see https://w3.cs.jmu.edu/bernstdh/web/common/help/nmea-sentences.php
 */
class ROT extends BaseSentence
{
    public float $rateOfTurn;

    public ?FixStatus $status;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([-0-9\.]*),'
        .'([AV])'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->rateOfTurn = (float) $matches[2];
        $this->status = FixStatus::tryFrom($matches[3]);
    }
}
