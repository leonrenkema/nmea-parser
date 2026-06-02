<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GST;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GSTTest extends TestCase
{
    #[Test]
    public function test_gst_sentence(): void
    {
        $parser = new Parser;
        /** @var GST $sentence */
        $sentence = $parser->parse('$GPGST,024603.00,1.2,0.8,0.6,45.0,0.5,0.4,0.9*60');

        $this->assertInstanceOf(GST::class, $sentence);
        $this->assertSame('024603.00', $sentence->time);
        $this->assertSame(1.2, $sentence->rmsDeviation);
        $this->assertSame(0.5, $sentence->latitudeErrorDeviation);
        $this->assertSame(0.9, $sentence->altitudeErrorDeviation);
    }
}
