<?php
declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\SystemMode;

class RMC extends BaseSentence
{
    public FixStatus $status;
    public string $latitude;
    public string $longitude;
    public Direction $latitudeDirection;
    public Direction $longitudeDirection;
    public float $groundSpeed;

    protected string $frameRegex = '/^'
    . '([A-Z]{2}[A-Z]{3}),' //Equipment and trame type
    . '(\d{6})(\.\d{2,3})?,' //Time (UTC)
    . '(A|V),' //Status A=active or V=Void
    . '([0-9\.]+),' //Latitude
    . '(N|S),' //N or S (North or South)
    . '([0-9\.]+),' //Longitude
    . '(E|W),' //E or W (East or West)
    . '([0-9\.]*),' //Speed over ground in knots
    . '([0-9\.]*),' //Track angle in degrees True
    . '(\d{6}),' //Date
    . '([0-9\.]*),' //Magnetic variation degrees
    //(Easterly var. subtracts from true course)
    . '(E|W)?' //E or W (East or West)
    . '(,(A|D|E|N|S)?)?' //Mode indicator (NMEA >= 2.3)
    . '$/m';

    protected function matchFields($matches): void
    {
        $this->status = FixStatus::from($matches[4]);
        $this->latitude = $matches[5];
        $this->latitudeDirection = Direction::from($matches[6]);
        $this->longitude = $matches[7];
        $this->longitudeDirection = Direction::from($matches[8]);
        $this->groundSpeed = floatval($matches[9]);
    }
}