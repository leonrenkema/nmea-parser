<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\DPT;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DPTTest extends TestCase
{
    #[Test]
    public function test_dpt_sentence(): void
    {
        $parser = new Parser;
        /** @var DPT $sentence */
        $sentence = $parser->parse('$SDDPT,30.5,0.5,100.0*67');

        $this->assertInstanceOf(DPT::class, $sentence);
        $this->assertSame(30.5, $sentence->depth);
        $this->assertSame(100.0, $sentence->maximumRange);
    }
}
