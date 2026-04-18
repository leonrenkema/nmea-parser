<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\ModeIndicator;

class GLL extends BaseSentence
{
    public string $latitude;

    public ?Direction $latitudeDirection;

    public string $longitude;

    public ?Direction $longitudeDirection;

    public ?FixStatus $status;

    public ?ModeIndicator $mode;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),' // Equipment and trame type
        .'([0-9\.]+)?,' // Latitude
        .'(N|S)?,' // N or S (North or South)
        .'([0-9\.]+)?,' // Longitude
        .'(E|W)?,' // E or W (East or West)
        .'(\d{6})(\.\d{2,3})?,' // Time (UTC)
        .'(A|V)' // Status A=active or V=Void
        .'(,(A|D|E|N|S)?)?' // Mode indicator (NMEA >= 2.3)
        .'$/m';

    protected function matchFields($matches): void
    {
        $this->latitude = $matches[2];
        $this->latitudeDirection = Direction::tryFrom($matches[3]);
        $this->longitude = $matches[4];
        $this->longitudeDirection = Direction::tryFrom($matches[5]);
        $this->status = FixStatus::tryFrom($matches[8]);
        $this->mode = ModeIndicator::tryFrom($matches[10]);
    }
}
