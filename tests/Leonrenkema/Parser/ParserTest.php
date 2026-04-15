<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\SystemMode;
use Leonrenkema\NmeaParser\Exceptions\ChecksumInvalidException;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GLL;
use Leonrenkema\NmeaParser\Sentence\GSV;
use Leonrenkema\NmeaParser\Sentence\RMC;
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

    function nmeaToDecimal($nmeaCoord, $direction) {
        if (empty($nmeaCoord)) return 0.0;

        // NMEA format: (D)DDMM.MMMM
        // Latitude has 2 degree digits (DD), Longitude has 3 (DDD)
        $dotPos = strpos($nmeaCoord, '.');
        $degDigits = ($dotPos !== false) ? $dotPos - 2 : strlen($nmeaCoord) - 2;

        $degrees = substr($nmeaCoord, 0, $degDigits);
        $minutes = substr($nmeaCoord, $degDigits);

        $decimal = $degrees + ($minutes / 60);

        // Apply hemisphere sign
        if (strtoupper($direction) == 'S' || strtoupper($direction) == 'W') {
            $decimal *= -1;
        }

        return round($decimal, 6);
    }

    function decimalToDMS($decimal) {
        // 1. Degrees are the integer part
        $degrees = floor(abs($decimal));

        // 2. Minutes are the decimal part * 60
        $fractionalMinutes = (abs($decimal) - $degrees) * 60;
        $minutes = floor($fractionalMinutes);

        // 3. Seconds are the remaining decimal part * 60
        $seconds = ($fractionalMinutes - $minutes) * 60;

        return [
            'degrees' => ($decimal < 0 ? -$degrees : $degrees),
            'minutes' => $minutes,
            'seconds' => round($seconds, 2) // Rounding for readability
        ];
    }

    public function testName()
    {
        $a = $this->nmeaToDecimal(5158.34572, 'N');
        $result = $this->decimalToDMS($a);
        echo "{$result['degrees']}° {$result['minutes']}' {$result['seconds']}\"";
    }
}
