<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\RTE;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RTETest extends TestCase
{
    #[Test]
    public function test_rte_sentence(): void
    {
        $parser = new Parser;
        /** @var RTE $sentence */
        $sentence = $parser->parse('$GPRTE,1,1,c,START,MID,DEST*31');

        $this->assertInstanceOf(RTE::class, $sentence);
        $this->assertSame(['START', 'MID', 'DEST'], $sentence->waypointIds);
    }
}
