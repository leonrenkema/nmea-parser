<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * GSA - GNSS DOP and active satellites.
 *
 * Contains fix selection mode, fix type, active satellite identifiers, and
 * PDOP/HDOP/VDOP dilution-of-precision values.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class GSA extends BaseSentence
{
    public string $selectionMode;

    public int $fixType;

    /** @var array<int, string> */
    public array $satelliteIds;

    public float $pdop;

    public float $hdop;

    public float $vdop;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([AM]),'
        .'([123]),'
        .'([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),'
        .'([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->selectionMode = $matches[2];
        $this->fixType = (int) $matches[3];
        $this->satelliteIds = array_values(array_filter(array_slice($matches, 4, 12), fn (string $id): bool => $id !== ''));
        $this->pdop = (float) $matches[16];
        $this->hdop = (float) $matches[17];
        $this->vdop = (float) $matches[18];
    }
}
