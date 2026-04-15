<?php

namespace Leonrenkema\NmeaParser\Enums;

enum Direction: string
{
    case North = 'N';
    case South = 'S';
    case East = 'E';
    case West = 'W';
}