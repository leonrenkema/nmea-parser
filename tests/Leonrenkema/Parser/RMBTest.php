<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\SteerDirection;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\RMB;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RMBTest extends TestCase
{
    #[Test]
    public function test_rmb_sentence(): void
    {
        $parser = new Parser;
        /** @var RMB $sentence */
        $sentence = $parser->parse('$GPRMB,A,0.67,L,START,DEST,4807.038,N,01131.000,E,10.5,045.0,5.5,A,A*3C');

        $this->assertInstanceOf(RMB::class, $sentence);
        $this->assertSame(SteerDirection::Left, $sentence->steerDirection);
        $this->assertSame('START', $sentence->originWaypointId);
        $this->assertSame('DEST', $sentence->destinationWaypointId);
    }
}
