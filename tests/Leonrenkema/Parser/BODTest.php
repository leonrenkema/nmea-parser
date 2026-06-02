<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\BOD;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class BODTest extends TestCase
{
    #[Test]
    public function test_bod_sentence(): void
    {
        $parser = new Parser;
        /** @var BOD $sentence */
        $sentence = $parser->parse('$GPBOD,045.0,T,023.0,M,DEST,START*01');

        $this->assertInstanceOf(BOD::class, $sentence);
        $this->assertSame(45.0, $sentence->bearingTrue);
        $this->assertSame('DEST', $sentence->destinationWaypointId);
    }
}
