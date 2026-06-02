<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GGA;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GGATest extends TestCase
{
    #[Test]
    public function test_gga_sentence(): void
    {
        $parser = new Parser;
        /** @var GGA $sentence */
        $sentence = $parser->parse('$GPGGA,123519,4807.038,N,01131.000,E,1,08,0.9,545.4,M,46.9,M,,*47');

        $this->assertInstanceOf(GGA::class, $sentence);
        $this->assertSame('123519', $sentence->time);
        $this->assertSame('4807.038', $sentence->latitude);
        $this->assertSame(Direction::North, $sentence->latitudeDirection);
        $this->assertSame('01131.000', $sentence->longitude);
        $this->assertSame(Direction::East, $sentence->longitudeDirection);
        $this->assertSame(1, $sentence->fixQuality);
        $this->assertSame(8, $sentence->numberOfSatellites);
        $this->assertSame(545.4, $sentence->altitude);
    }
}
