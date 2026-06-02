<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\MTW;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MTWTest extends TestCase
{
    #[Test]
    public function test_mtw_sentence(): void
    {
        $parser = new Parser;
        /** @var MTW $sentence */
        $sentence = $parser->parse('$YXMTW,18.4,C*1F');

        $this->assertInstanceOf(MTW::class, $sentence);
        $this->assertSame(18.4, $sentence->temperature);
    }
}
