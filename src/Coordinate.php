<?php

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
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'degrees' => $this->degrees,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds,
            'direction' => $this->direction,
        ];
    }
}