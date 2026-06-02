<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GSA;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GSATest extends TestCase
{
    #[Test]
    public function test_gsa_sentence(): void
    {
        $parser = new Parser;
        /** @var GSA $sentence */
        $sentence = $parser->parse('$GPGSA,A,3,04,05,09,12,24,25,29,,,,,,1.8,1.0,1.5*3F');

        $this->assertInstanceOf(GSA::class, $sentence);
        $this->assertSame('A', $sentence->selectionMode);
        $this->assertSame(3, $sentence->fixType);
        $this->assertSame(['04', '05', '09', '12', '24', '25', '29'], $sentence->satelliteIds);
        $this->assertSame(1.8, $sentence->pdop);
        $this->assertSame(1.0, $sentence->hdop);
        $this->assertSame(1.5, $sentence->vdop);
    }
}
