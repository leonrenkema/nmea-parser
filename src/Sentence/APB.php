<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\ModeIndicator;
use Leonrenkema\NmeaParser\Enums\SteerDirection;

/**
 * APB - Autopilot sentence "B".
 *
 * Contains cross-track error, steering direction, arrival status, waypoint
 * bearing, and heading-to-steer values used by navigation/autopilot systems.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class APB extends BaseSentence
{
    public ?FixStatus $status;

    public ?FixStatus $cycleLockStatus;

    public float $crossTrackErrorMagnitude;

    public ?SteerDirection $steerDirection;

    public string $crossTrackUnits;

    public ?FixStatus $arrivalCircleStatus;

    public ?FixStatus $perpendicularPassedStatus;

    public float $bearingOriginToDestination;

    public string $bearingOriginToDestinationType;

    public string $destinationWaypointId;

    public float $bearingPresentPositionToDestination;

    public string $bearingPresentPositionToDestinationType;

    public float $headingToSteer;

    public string $headingToSteerType;

    public ?ModeIndicator $mode;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([AV]),([AV]),'
        .'([0-9\.]*),(L|R)?,([A-Z]),'
        .'([AV]),([AV]),'
        .'([0-9\.]*),([A-Z]),'
        .'([^,]*),'
        .'([0-9\.]*),([A-Z]),'
        .'([0-9\.]*),([A-Z])'
        .'(?:,(A|D|E|N|S)?)?'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->status = FixStatus::tryFrom($matches[2]);
        $this->cycleLockStatus = FixStatus::tryFrom($matches[3]);
        $this->crossTrackErrorMagnitude = (float) $matches[4];
        $this->steerDirection = SteerDirection::tryFrom($matches[5]);
        $this->crossTrackUnits = $matches[6];
        $this->arrivalCircleStatus = FixStatus::tryFrom($matches[7]);
        $this->perpendicularPassedStatus = FixStatus::tryFrom($matches[8]);
        $this->bearingOriginToDestination = (float) $matches[9];
        $this->bearingOriginToDestinationType = $matches[10];
        $this->destinationWaypointId = $matches[11];
        $this->bearingPresentPositionToDestination = (float) $matches[12];
        $this->bearingPresentPositionToDestinationType = $matches[13];
        $this->headingToSteer = (float) $matches[14];
        $this->headingToSteerType = $matches[15];
        $this->mode = ModeIndicator::tryFrom($matches[16] ?? '');
    }
}
