<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\RMC;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RMCTest extends TestCase
{
    #[Test]
    public function test_rmc_sentence(): void
    {
        $parser = new Parser;
        /** @var RMC $sentence */
        $sentence = $parser->parse('$GPRMC,053949.00,A,5158.34572,N,00553.72838,E,2.116,,150426,,,A*79');

        $this->assertInstanceOf(RMC::class, $sentence);
        $this->assertSame(FixStatus::Active, $sentence->status);
        $this->assertSame('5158.34572', $sentence->latitude);
        $this->assertSame(Direction::North, $sentence->latitudeDirection);
        $this->assertSame('00553.72838', $sentence->longitude);
        $this->assertSame(Direction::East, $sentence->longitudeDirection);
        $this->assertSame(2.116, $sentence->groundSpeed);
    }
}
