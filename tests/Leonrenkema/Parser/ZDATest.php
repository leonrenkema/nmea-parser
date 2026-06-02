<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\ZDA;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ZDATest extends TestCase
{
    #[Test]
    public function test_zda_sentence(): void
    {
        $parser = new Parser;
        /** @var ZDA $sentence */
        $sentence = $parser->parse('$GPZDA,201530.00,04,07,2002,00,00*60');

        $this->assertInstanceOf(ZDA::class, $sentence);
        $this->assertSame('201530.00', $sentence->time);
        $this->assertSame(4, $sentence->day);
        $this->assertSame(7, $sentence->month);
        $this->assertSame(2002, $sentence->year);
        $this->assertSame(0, $sentence->localZoneHours);
        $this->assertSame(0, $sentence->localZoneMinutes);
    }

    #[Test]
    public function test_zda_sentence_with_local_zone_offset(): void
    {
        $parser = new Parser;
        /** @var ZDA $sentence */
        $sentence = $parser->parse('$GPZDA,201530.00,04,07,2002,-05,30*4B');

        $this->assertSame(-5, $sentence->localZoneHours);
        $this->assertSame(30, $sentence->localZoneMinutes);
    }
}
