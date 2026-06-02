<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\ROT;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ROTTest extends TestCase
{
    #[Test]
    public function test_rot_sentence(): void
    {
        $parser = new Parser;
        /** @var ROT $sentence */
        $sentence = $parser->parse('$TIROT,-15.5,A*27');

        $this->assertInstanceOf(ROT::class, $sentence);
        $this->assertSame(-15.5, $sentence->rateOfTurn);
    }
}
