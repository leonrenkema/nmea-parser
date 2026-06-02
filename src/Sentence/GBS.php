<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * GBS - GNSS satellite fault detection.
 *
 * Contains estimated position error and optional details about a satellite
 * suspected of causing degraded GNSS accuracy.
 *
 * @see https://mapitgis.com/docs/external-gnss/nmea-protocol
 */
class GBS extends BaseSentence
{
    public string $time;

    public float $latitudeError;

    public float $longitudeError;

    public float $altitudeError;

    public ?int $satelliteId;

    public ?float $probabilityOfMissedDetection;

    public ?float $bias;

    public ?float $standardDeviation;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'(\d{6}(?:\.\d{1,3})?),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([0-9\.]*),'
        .'([^,]*),'
        .'([^,]*),'
        .'([^,]*),'
        .'([^,]*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->time = $matches[2];
        $this->latitudeError = (float) $matches[3];
        $this->longitudeError = (float) $matches[4];
        $this->altitudeError = (float) $matches[5];
        $this->satelliteId = $matches[6] === '' ? null : (int) $matches[6];
        $this->probabilityOfMissedDetection = $matches[7] === '' ? null : (float) $matches[7];
        $this->bias = $matches[8] === '' ? null : (float) $matches[8];
        $this->standardDeviation = $matches[9] === '' ? null : (float) $matches[9];
    }
}
