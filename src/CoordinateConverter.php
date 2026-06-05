<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser;

use Leonrenkema\NmeaParser\Enums\Direction;

class CoordinateConverter
{
    public function nmeaToDecimal(string $nmeaCoord, Direction $direction): float
    {
        if (empty($nmeaCoord)) {
            return 0.0;
        }

        // NMEA format: (D)DDMM.MMMM
        // Latitude has 2 degree digits (DD), Longitude has 3 (DDD)
        $dotPos = strpos($nmeaCoord, '.');
        $degDigits = ($dotPos !== false) ? $dotPos - 2 : strlen($nmeaCoord) - 2;

        $degrees = (int) substr($nmeaCoord, 0, $degDigits);
        $minutes = (float) substr($nmeaCoord, $degDigits);

        $decimal = $degrees + ($minutes / 60);

        if ($direction === Direction::South || $direction === Direction::West) {
            $decimal = -$decimal;
        }

        return round($decimal, 6);
    }

    public function decimalToDMS(float $decimal, Direction $positiveDirection): Coordinate
    {
        // 1. Degrees are the integer part
        $degrees = floor(abs($decimal));

        // 2. Minutes are the decimal part * 60
        $fractionalMinutes = (abs($decimal) - $degrees) * 60;
        $minutes = floor($fractionalMinutes);

        // 3. Seconds are the remaining decimal part * 60
        $seconds = ($fractionalMinutes - $minutes) * 60;

        return new Coordinate(
            $degrees,
            $minutes,
            round($seconds, 2),
            $this->directionForDecimal($decimal, $positiveDirection),
        );
    }

    private function directionForDecimal(float $decimal, Direction $positiveDirection): Direction
    {
        return match ($positiveDirection) {
            Direction::North => $decimal < 0 ? Direction::South : Direction::North,
            Direction::East => $decimal < 0 ? Direction::West : Direction::East,
            Direction::South, Direction::West => $positiveDirection,
        };
    }
}
