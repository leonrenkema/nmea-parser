<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * DPT - Depth of water.
 *
 * Contains water depth, transducer offset, and optional maximum depth range
 * reported by a depth sensor.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class DPT extends BaseSentence
{
    public float $depth;

    public ?float $offset;

    public ?float $maximumRange;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([-0-9\.]*),'
        .'([-0-9\.]*)'
        .'(?:,([-0-9\.]*))?'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->depth = (float) $matches[2];
        $this->offset = $matches[3] === '' ? null : (float) $matches[3];
        $this->maximumRange = ($matches[4] ?? '') === '' ? null : (float) $matches[4];
    }
}
