<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\FixStatus;

/**
 * MWV - Wind speed and angle.
 *
 * Contains wind angle, reference type, wind speed, speed unit, and status for
 * apparent or true wind measurements.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class MWV extends BaseSentence
{
    public float $windAngle;

    public string $reference;

    public float $windSpeed;

    public string $windSpeedUnit;

    public ?FixStatus $status;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),'
        .'([RT]),'
        .'([0-9\.]*),'
        .'([KMSN]),'
        .'([AV])'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->windAngle = (float) $matches[2];
        $this->reference = $matches[3];
        $this->windSpeed = (float) $matches[4];
        $this->windSpeedUnit = $matches[5];
        $this->status = FixStatus::tryFrom($matches[6]);
    }
}
