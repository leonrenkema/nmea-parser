<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;

/**
 * GGA - Global positioning system fix data.
 *
 * Contains UTC time, position, fix quality, satellite count, HDOP, altitude,
 * geoidal separation, and optional differential correction details.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class GGA extends BaseSentence
{
    public string $time;

    public string $latitude;

    public ?Direction $latitudeDirection;

    public string $longitude;

    public ?Direction $longitudeDirection;

    public int $fixQuality;

    public int $numberOfSatellites;

    public float $hdop;

    public float $altitude;

    public string $altitudeUnit;

    public float $geoidalSeparation;

    public string $geoidalSeparationUnit;

    public ?float $differentialAge;

    public ?string $differentialStationId;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'(\d{6}(?:\.\d{1,3})?),'
        .'([0-9\.]*),(N|S)?,'
        .'([0-9\.]*),(E|W)?,'
        .'(\d*),'
        .'(\d*),'
        .'([0-9\.]*),'
        .'([-0-9\.]*),([A-Z]?),'
        .'([-0-9\.]*),([A-Z]?),'
        .'([^,]*),'
        .'([^,]*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->time = $matches[2];
        $this->latitude = $matches[3];
        $this->latitudeDirection = Direction::tryFrom($matches[4]);
        $this->longitude = $matches[5];
        $this->longitudeDirection = Direction::tryFrom($matches[6]);
        $this->fixQuality = (int) $matches[7];
        $this->numberOfSatellites = (int) $matches[8];
        $this->hdop = (float) $matches[9];
        $this->altitude = (float) $matches[10];
        $this->altitudeUnit = $matches[11];
        $this->geoidalSeparation = (float) $matches[12];
        $this->geoidalSeparationUnit = $matches[13];
        $this->differentialAge = $matches[14] === '' ? null : (float) $matches[14];
        $this->differentialStationId = $matches[15] === '' ? null : $matches[15];
    }
}
