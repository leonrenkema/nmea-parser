<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\ModeIndicator;

/**
 * VTG - Course over ground and ground speed.
 *
 * Contains true/magnetic track made good, ground speed in knots and kilometers
 * per hour, and optional mode indicator.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class VTG extends BaseSentence
{
    public float $track;

    public float $trackMadeGood;

    public ?ModeIndicator $mode;

    public float $speedInKnots;

    public float $speedInKmh;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),' // Equipment and trame type
        .'([0-9\.]*),T,' // True track made good (degrees)
        .'([0-9\.]*),M,' // Magnetic track made good
        .'([0-9\.]*),N,' // Ground speed, knots
        .'([0-9\.]*),K' // Ground speed, Kilometers per hour
        .'(,(A|D|E|N|S)?)?' // Mode indicator (NMEA >= 2.3)
        .'$/m';

    protected function matchFields($matches): void
    {
        $this->track = floatval($matches[2]);
        $this->trackMadeGood = floatval($matches[3]);

        $this->speedInKnots = floatval($matches[4]);
        $this->speedInKmh = floatval($matches[5]);

        if (($matches[7] ?? null) !== null) {
            $this->mode = ModeIndicator::tryFrom($matches[7]);
        } else {
            $this->mode = null;
        }
    }
}
