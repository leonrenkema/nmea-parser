<?php
declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\SystemMode;

class VTG extends BaseSentence
{
    protected string $frameRegex = '/^'
    .'([A-Z]{2}[A-Z]{3}),' //Equipment and trame type
    .'([0-9\.]*),T,' //True track made good (degrees)
    .'([0-9\.]*),M,' //Magnetic track made good
    .'([0-9\.]*),N,' //Ground speed, knots
    .'([0-9\.]*),K' //Ground speed, Kilometers per hour
    .'(,(A|D|E|N|S)?)?' //Mode indicator (NMEA >= 2.3)
    .'$/m';

    protected function matchFields($matches): void
    {
    }
}