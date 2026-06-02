<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\ModeIndicator;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\BWC;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class BWCTest extends TestCase
{
    #[Test]
    public function test_bwc_sentence(): void
    {
        $parser = new Parser;
        /** @var BWC $sentence */
        $sentence = $parser->parse('$GPBWC,123519,4807.038,N,01131.000,E,045.0,T,023.0,M,10.5,N,DEST,A*53');

        $this->assertInstanceOf(BWC::class, $sentence);
        $this->assertSame(10.5, $sentence->distanceNauticalMiles);
        $this->assertSame(ModeIndicator::Autonomous, $sentence->mode);
    }
}
