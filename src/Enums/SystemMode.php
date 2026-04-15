<?php

namespace Leonrenkema\NmeaParser\Enums;

enum SystemMode: string
{
    case Autonomous = 'A';
    case Differential = 'D';
    case Estimated = 'E';
    case Manual = 'M';
    case NotValid = 'N';
}