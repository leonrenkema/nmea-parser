<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\WPL;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class WPLTest extends TestCase
{
    #[Test]
    public function test_wpl_sentence(): void
    {
        $parser = new Parser;
        /** @var WPL $sentence */
        $sentence = $parser->parse('$GPWPL,4807.038,N,01131.000,E,DEST*4F');

        $this->assertInstanceOf(WPL::class, $sentence);
        $this->assertSame('DEST', $sentence->waypointId);
    }
}
