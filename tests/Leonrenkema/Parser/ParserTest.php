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
    public function test_rmc_sentence(): void
    {
        $parser = new Parser();
        /** @var RMC $sentence */
        $sentence = $parser->parse('$GPRMC,053949.00,A,5158.34572,N,00553.72838,E,2.116,,150426,,,A*79');

        $this->assertSame(FixStatus::Active, $sentence->status);
        $this->assertSame('5158.34572', $sentence->latitude);
        $this->assertSame(Direction::North, $sentence->latitudeDirection);
        $this->assertSame('00553.72838', $sentence->longitude);
        $this->assertSame(Direction::East, $sentence->longitudeDirection);
        $this->assertSame(2.116, $sentence->groundSpeed);
    }

    #[Test]
    public function throws_an_error_when_checksum_not_valid(): void
    {
        $parser = new Parser();

        $this->expectException(ChecksumInvalidException::class);
        $parser->parse('$GPGLL,5158.34572,N,00553.72838,E,053949.00,A,A*12');
    }

    #[Test]
    public function test_vtg_sentence(): void
    {
        $parser = new Parser();
        /** @var VTG $sentence */
        $sentence = $parser->parse('$GPVTG,,T,,M,2.116,N,3.919,K,A*25');

        $this->assertSame(ModeIndicator::Autonomous, $sentence->mode);
        $this->assertSame(2.116, $sentence->speedInKnots);
        $this->assertSame(3.919, $sentence->speedInKmh);
    }

}
