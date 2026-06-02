<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\HDG;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HDGTest extends TestCase
{
    #[Test]
    public function test_hdg_sentence(): void
    {
        $parser = new Parser;
        /** @var HDG $sentence */
        $sentence = $parser->parse('$HEHDG,274.07,1.2,E,2.3,W*62');

        $this->assertInstanceOf(HDG::class, $sentence);
        $this->assertSame(274.07, $sentence->heading);
        $this->assertSame(Direction::East, $sentence->deviationDirection);
        $this->assertSame(Direction::West, $sentence->variationDirection);
    }
}
