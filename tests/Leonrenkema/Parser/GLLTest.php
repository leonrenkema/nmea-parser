<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\ModeIndicator;
use Leonrenkema\NmeaParser\Enums\SystemMode;
use Leonrenkema\NmeaParser\Exceptions\ChecksumInvalidException;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GLL;
use Leonrenkema\NmeaParser\Sentence\GSV;
use Leonrenkema\NmeaParser\Sentence\RMC;
use Leonrenkema\NmeaParser\Sentence\VTG;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GLLTest extends TestCase
{
    #[Test]
    public function test(): void
    {
        $parser = new Parser();
        /** @var GLL $sentence */
        $sentence = $parser->parse('$GPGLL,,,,,182429.00,V,N*4E');

        $this->assertSame(ModeIndicator::NotValid, $sentence->mode);
        $this->assertSame(FixStatus::Void, $sentence->status);
    }
}
