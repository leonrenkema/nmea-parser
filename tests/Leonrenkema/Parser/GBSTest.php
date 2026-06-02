<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GBS;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GBSTest extends TestCase
{
    #[Test]
    public function test_gbs_sentence(): void
    {
        $parser = new Parser;
        /** @var GBS $sentence */
        $sentence = $parser->parse('$GPGBS,024603.00,1.1,2.2,3.3,04,0.9,0.5,1.0*65');

        $this->assertInstanceOf(GBS::class, $sentence);
        $this->assertSame('024603.00', $sentence->time);
        $this->assertSame(1.1, $sentence->latitudeError);
        $this->assertSame(4, $sentence->satelliteId);
        $this->assertSame(1.0, $sentence->standardDeviation);
    }
}
