<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * HDM - Heading, magnetic.
 *
 * Contains vessel heading referenced to magnetic north.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class HDM extends BaseSentence
{
    public float $heading;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),M'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->heading = (float) $matches[2];
    }
}
