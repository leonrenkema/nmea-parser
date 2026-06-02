<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * DBT - Depth below transducer.
 *
 * Contains water depth below the transducer in feet, meters, and fathoms.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class DBT extends BaseSentence
{
    public float $depthFeet;

    public float $depthMeters;

    public float $depthFathoms;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),f,'
        .'([0-9\.]*),M,'
        .'([0-9\.]*),F'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->depthFeet = (float) $matches[2];
        $this->depthMeters = (float) $matches[3];
        $this->depthFathoms = (float) $matches[4];
    }
}
