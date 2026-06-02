<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * GST - GNSS pseudorange error statistics.
 *
 * Contains RMS and standard-deviation error estimates for latitude, longitude,
 * altitude, and the error ellipse of a GNSS fix.
 *
 * @see https://mapitgis.com/docs/external-gnss/nmea-protocol
 */
class GST extends BaseSentence
{
    public string $time;

    public float $rmsDeviation;

    public float $semiMajorDeviation;

    public float $semiMinorDeviation;

    public float $semiMajorOrientation;

    public float $latitudeErrorDeviation;

    public float $longitudeErrorDeviation;

    public float $altitudeErrorDeviation;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'(\d{6}(?:\.\d{1,3})?),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->time = $matches[2];
        $this->rmsDeviation = (float) $matches[3];
        $this->semiMajorDeviation = (float) $matches[4];
        $this->semiMinorDeviation = (float) $matches[5];
        $this->semiMajorOrientation = (float) $matches[6];
        $this->latitudeErrorDeviation = (float) $matches[7];
        $this->longitudeErrorDeviation = (float) $matches[8];
        $this->altitudeErrorDeviation = (float) $matches[9];
    }
}
