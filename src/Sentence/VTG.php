<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\ModeIndicator;

class VTG extends BaseSentence
{
    public $track;

    public $trackMadeGood;

    public ModeIndicator $mode;

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
        $this->track = $matches[2];
        $this->speedInKnots = floatval($matches[4]);
        $this->speedInKmh = floatval($matches[5]);
        $this->mode = ModeIndicator::tryFrom($matches[7]);
    }
}
