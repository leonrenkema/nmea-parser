<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\HDM;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HDMTest extends TestCase
{
    #[Test]
    public function test_hdm_sentence(): void
    {
        $parser = new Parser;
        /** @var HDM $sentence */
        $sentence = $parser->parse('$HEHDM,273.5,M*2C');

        $this->assertInstanceOf(HDM::class, $sentence);
        $this->assertSame(273.5, $sentence->heading);
    }
}
