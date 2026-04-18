<?php

namespace Leonrenkema\NmeaParser\Enums;

enum FixStatus: string
{
    case Active = 'A';
    case Void = 'V';
}
