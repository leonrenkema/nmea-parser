<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\SteerDirection;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\APB;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class APBTest extends TestCase
{
    #[Test]
    public function test_apb_sentence(): void
    {
        $parser = new Parser;
        /** @var APB $sentence */
        $sentence = $parser->parse('$GPAPB,A,A,0.67,L,N,A,A,045.0,T,DEST,046.0,T,047.0,T,A*48');

        $this->assertInstanceOf(APB::class, $sentence);
        $this->assertSame(SteerDirection::Left, $sentence->steerDirection);
        $this->assertSame(47.0, $sentence->headingToSteer);
    }
}
