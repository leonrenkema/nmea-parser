<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\TXT;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TXTTest extends TestCase
{
    #[Test]
    public function test_txt_sentence(): void
    {
        $parser = new Parser;
        /** @var TXT $sentence */
        $sentence = $parser->parse('$GPTXT,01,01,02,u-blox ag - www.u-blox.com*50');

        $this->assertInstanceOf(TXT::class, $sentence);
        $this->assertSame(1, $sentence->totalMessages);
        $this->assertSame(1, $sentence->messageNumber);
        $this->assertSame(2, $sentence->messageType);
        $this->assertSame('u-blox ag - www.u-blox.com', $sentence->text);
    }
}
