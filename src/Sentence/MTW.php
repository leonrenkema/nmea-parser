<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * MTW - Water temperature.
 *
 * Contains water temperature in degrees Celsius from a marine sensor.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class MTW extends BaseSentence
{
    public float $temperature;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([-0-9\.]*),C'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->temperature = (float) $matches[2];
    }
}
