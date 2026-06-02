<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\MWV;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MWVTest extends TestCase
{
    #[Test]
    public function test_mwv_sentence(): void
    {
        $parser = new Parser;
        /** @var MWV $sentence */
        $sentence = $parser->parse('$IIMWV,045.0,R,10.5,N,A*08');

        $this->assertInstanceOf(MWV::class, $sentence);
        $this->assertSame(10.5, $sentence->windSpeed);
        $this->assertSame(FixStatus::Active, $sentence->status);
    }
}
