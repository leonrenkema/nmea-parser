<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\DBT;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DBTTest extends TestCase
{
    #[Test]
    public function test_dbt_sentence(): void
    {
        $parser = new Parser;
        /** @var DBT $sentence */
        $sentence = $parser->parse('$SDDBT,100.0,f,30.5,M,16.7,F*01');

        $this->assertInstanceOf(DBT::class, $sentence);
        $this->assertSame(30.5, $sentence->depthMeters);
    }
}
