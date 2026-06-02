<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GSV;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GSVTest extends TestCase
{
    #[Test]
    public function test_gsv_sentence(): void
    {
        $parser = new Parser;
        /** @var GSV $sentence */
        $sentence = $parser->parse('$GPGSV,3,1,11,03,03,111,00,04,15,270,00,06,01,010,00,13,06,292,00*74');

        $this->assertInstanceOf(GSV::class, $sentence);
        $this->assertSame(3, $sentence->numberOfMessages);
        $this->assertSame(11, $sentence->numberOfSatellites);
    }
}
