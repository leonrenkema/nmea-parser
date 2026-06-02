<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\HDT;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HDTTest extends TestCase
{
    #[Test]
    public function test_hdt_sentence(): void
    {
        $parser = new Parser;
        /** @var HDT $sentence */
        $sentence = $parser->parse('$HEHDT,274.07,T*19');

        $this->assertInstanceOf(HDT::class, $sentence);
        $this->assertSame(274.07, $sentence->heading);
    }
}
