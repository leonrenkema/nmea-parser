<?php

namespace Leonrenkema\NmeaParser\Enums;

enum ModeIndicator: string
{
    case Autonomous = 'A';
    case Differential = 'D';
    case DeadReckoning = 'E';
    case Manual = 'M';
    case Simulator = 'S';
    case NotValid = 'N';
}
