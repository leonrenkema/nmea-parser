<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * BOD - Bearing from origin to destination waypoint.
 *
 * Contains true and magnetic bearing between an origin waypoint and a
 * destination waypoint, along with both waypoint identifiers.
 *
 * @see https://w3.cs.jmu.edu/bernstdh/web/common/help/nmea-sentences.php
 */
class BOD extends BaseSentence
{
    public float $bearingTrue;

    public float $bearingMagnetic;

    public string $destinationWaypointId;

    public string $originWaypointId;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([0-9\.]*),T,'
        .'([0-9\.]*),M,'
        .'([^,]*),'
        .'([^,]*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->bearingTrue = (float) $matches[2];
        $this->bearingMagnetic = (float) $matches[3];
        $this->destinationWaypointId = $matches[4];
        $this->originWaypointId = $matches[5];
    }
}
