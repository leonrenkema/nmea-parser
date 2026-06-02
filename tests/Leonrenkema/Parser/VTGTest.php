<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\ModeIndicator;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\VTG;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class VTGTest extends TestCase
{
    #[Test]
    public function test_vtg_sentence(): void
    {
        $parser = new Parser;
        /** @var VTG $sentence */
        $sentence = $parser->parse('$GPVTG,,T,,M,2.116,N,3.919,K,A*25');

        $this->assertInstanceOf(VTG::class, $sentence);
        $this->assertSame(ModeIndicator::Autonomous, $sentence->mode);
        $this->assertSame(2.116, $sentence->speedInKnots);
        $this->assertSame(3.919, $sentence->speedInKmh);
    }

    #[Test]
    public function test_vtg_sentence2(): void
    {
        $parser = new Parser;
        /** @var VTG $sentence */
        $sentence = $parser->parse('$GPVTG,054.7,T,034.4,M,005.5,N,010.2,K*48');

        $this->assertSame(54.7, $sentence->track);
        $this->assertSame(5.5, $sentence->speedInKnots);
        $this->assertSame(10.2, $sentence->speedInKmh);
    }
}
