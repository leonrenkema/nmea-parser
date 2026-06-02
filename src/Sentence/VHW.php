<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * VHW - Water speed and heading.
 *
 * Contains true heading, magnetic heading, and vessel speed through water in
 * knots and kilometers per hour.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class VHW extends BaseSentence
{
    public float $headingTrue;

    public float $headingMagnetic;

    public float $speedKnots;

    public float $speedKmh;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),T,'
        .'([0-9\.]*),M,'
        .'([0-9\.]*),N,'
        .'([0-9\.]*),K'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->headingTrue = (float) $matches[2];
        $this->headingMagnetic = (float) $matches[3];
        $this->speedKnots = (float) $matches[4];
        $this->speedKmh = (float) $matches[5];
    }
}
