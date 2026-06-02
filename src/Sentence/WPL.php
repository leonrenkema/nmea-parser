<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;

/**
 * WPL - Waypoint location.
 *
 * Contains waypoint latitude, longitude, hemispheres, and waypoint identifier.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class WPL extends BaseSentence
{
    public string $latitude;

    public ?Direction $latitudeDirection;

    public string $longitude;

    public ?Direction $longitudeDirection;

    public string $waypointId;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),(N|S)?,'
        .'([0-9\.]*),(E|W)?,'
        .'([^,]*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->latitude = $matches[2];
        $this->latitudeDirection = Direction::tryFrom($matches[3]);
        $this->longitude = $matches[4];
        $this->longitudeDirection = Direction::tryFrom($matches[5]);
        $this->waypointId = $matches[6];
    }
}
