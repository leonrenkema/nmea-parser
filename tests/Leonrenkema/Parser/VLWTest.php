<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\VLW;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class VLWTest extends TestCase
{
    #[Test]
    public function test_vlw_sentence(): void
    {
        $parser = new Parser;
        /** @var VLW $sentence */
        $sentence = $parser->parse('$VWVLW,12.3,N,1.2,N*7F');

        $this->assertInstanceOf(VLW::class, $sentence);
        $this->assertSame(12.3, $sentence->totalDistanceNauticalMiles);
    }
}
