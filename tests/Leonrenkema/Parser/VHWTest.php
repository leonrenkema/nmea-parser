<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\VHW;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class VHWTest extends TestCase
{
    #[Test]
    public function test_vhw_sentence(): void
    {
        $parser = new Parser;
        /** @var VHW $sentence */
        $sentence = $parser->parse('$VWVHW,274.0,T,273.0,M,5.5,N,10.2,K*60');

        $this->assertInstanceOf(VHW::class, $sentence);
        $this->assertSame(5.5, $sentence->speedKnots);
    }
}
