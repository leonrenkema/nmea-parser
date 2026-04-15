<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\SystemMode;
use Leonrenkema\NmeaParser\Exceptions\ChecksumInvalidException;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GLL;
use Leonrenkema\NmeaParser\Sentence\GSV;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    #[Test]
    public function test(): void
    {
        $parser = new Parser();
        /** @var GLL $sentence */
        $sentence = $parser->parse('$GPGLL,5158.34572,N,00553.72838,E,053949.00,A,A*60');

        $this->assertSame(SystemMode::Autonomous, $sentence->mode);
        $this->assertSame('5158.34572', $sentence->latitude);
        $this->assertSame(Direction::North, $sentence->latitudeDirection);
        $this->assertSame('5158.34572', $sentence->latitude);
        $this->assertSame(Direction::East, $sentence->longitudeDirection);
        $this->assertSame('00553.72838', $sentence->longitude);
    }

    #[Test]
    public function test_gsv_sentence(): void
    {
        $parser = new Parser();
        /** @var GSV $sentence */
        $sentence = $parser->parse('$GPGSV,3,1,11,03,03,111,00,04,15,270,00,06,01,010,00,13,06,292,00*74');

        $this->assertSame(3, $sentence->numberOfMessages);
        $this->assertSame(11, $sentence->numberOfSatellites);
    }

    #[Test]
    public function throws_an_error_when_checksum_not_valid(): void
    {
        $parser = new Parser();

        $this->expectException(ChecksumInvalidException::class);
        $parser->parse('$GPGLL,5158.34572,N,00553.72838,E,053949.00,A,A*12');
    }
}
