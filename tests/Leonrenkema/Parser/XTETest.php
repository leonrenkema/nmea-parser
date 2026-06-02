<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\SteerDirection;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\XTE;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class XTETest extends TestCase
{
    #[Test]
    public function test_xte_sentence(): void
    {
        $parser = new Parser;
        /** @var XTE $sentence */
        $sentence = $parser->parse('$GPXTE,A,A,0.67,L,N,A*02');

        $this->assertInstanceOf(XTE::class, $sentence);
        $this->assertSame(0.67, $sentence->crossTrackErrorMagnitude);
        $this->assertSame(SteerDirection::Left, $sentence->steerDirection);
    }
}
