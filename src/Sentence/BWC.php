<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\ModeIndicator;

/**
 * BWC - Bearing and distance to waypoint.
 *
 * Contains waypoint position, bearing, distance, waypoint identifier, UTC time,
 * and optional mode indicator for waypoint navigation.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class BWC extends BaseSentence
{
    public string $time;

    public string $latitude;

    public ?Direction $latitudeDirection;

    public string $longitude;

    public ?Direction $longitudeDirection;

    public float $bearingTrue;

    public float $bearingMagnetic;

    public float $distanceNauticalMiles;

    public string $waypointId;

    public ?ModeIndicator $mode;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'(\d{6}(?:\.\d{1,3})?),'
        .'([0-9\.]*),(N|S)?,'
        .'([0-9\.]*),(E|W)?,'
        .'([0-9\.]*),T,'
        .'([0-9\.]*),M,'
        .'([0-9\.]*),N,'
        .'([^,]*)'
        .'(?:,(A|D|E|N|S)?)?'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->time = $matches[2];
        $this->latitude = $matches[3];
        $this->latitudeDirection = Direction::tryFrom($matches[4]);
        $this->longitude = $matches[5];
        $this->longitudeDirection = Direction::tryFrom($matches[6]);
        $this->bearingTrue = (float) $matches[7];
        $this->bearingMagnetic = (float) $matches[8];
        $this->distanceNauticalMiles = (float) $matches[9];
        $this->waypointId = $matches[10];
        $this->mode = ModeIndicator::tryFrom($matches[11] ?? '');
    }
}
