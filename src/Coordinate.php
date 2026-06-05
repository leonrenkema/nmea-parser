<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser;

use JsonSerializable;
use Leonrenkema\NmeaParser\Enums\Direction;

readonly class Coordinate implements JsonSerializable
{
    public function __construct(
        public float $degrees,
        public float $minutes,
        public float $seconds,
        public Direction $direction,
    ) {}

    /**
     * @return array{degrees: float, minutes: float, seconds: float, direction: Direction}
     */
    public function jsonSerialize(): array
    {
        return [
            'degrees' => $this->degrees,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds,
            'direction' => $this->direction,
        ];
    }
}
