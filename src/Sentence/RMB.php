<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\ModeIndicator;
use Leonrenkema\NmeaParser\Enums\SteerDirection;

/**
 * RMB - Recommended minimum navigation information.
 *
 * Contains cross-track error, origin and destination waypoints, destination
 * position, range, bearing, closing velocity, arrival status, and mode.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class RMB extends BaseSentence
{
    public ?FixStatus $status;

    public float $crossTrackError;

    public ?SteerDirection $steerDirection;

    public string $originWaypointId;

    public string $destinationWaypointId;

    public string $destinationLatitude;

    public ?Direction $destinationLatitudeDirection;

    public string $destinationLongitude;

    public ?Direction $destinationLongitudeDirection;

    public float $rangeToDestination;

    public float $bearingToDestination;

    public float $closingVelocity;

    public ?FixStatus $arrivalStatus;

    public ?ModeIndicator $mode;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([AV]),'
        .'([0-9\.]*),(L|R)?,'
        .'([^,]*),([^,]*),'
        .'([0-9\.]*),(N|S)?,'
        .'([0-9\.]*),(E|W)?,'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([AV])'
        .'(?:,(A|D|E|N|S)?)?'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->status = FixStatus::tryFrom($matches[2]);
        $this->crossTrackError = (float) $matches[3];
        $this->steerDirection = SteerDirection::tryFrom($matches[4]);
        $this->originWaypointId = $matches[5];
        $this->destinationWaypointId = $matches[6];
        $this->destinationLatitude = $matches[7];
        $this->destinationLatitudeDirection = Direction::tryFrom($matches[8]);
        $this->destinationLongitude = $matches[9];
        $this->destinationLongitudeDirection = Direction::tryFrom($matches[10]);
        $this->rangeToDestination = (float) $matches[11];
        $this->bearingToDestination = (float) $matches[12];
        $this->closingVelocity = (float) $matches[13];
        $this->arrivalStatus = FixStatus::tryFrom($matches[14]);
        $this->mode = ModeIndicator::tryFrom($matches[15] ?? '');
    }
}
