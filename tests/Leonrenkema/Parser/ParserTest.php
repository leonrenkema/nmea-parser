<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Exceptions\ChecksumInvalidException;
use Leonrenkema\NmeaParser\Parser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    #[Test]
    public function throws_an_error_when_checksum_not_valid(): void
    {
        $parser = new Parser;

        $this->expectException(ChecksumInvalidException::class);
        $parser->parse('$GPGLL,5158.34572,N,00553.72838,E,053949.00,A,A*12');
    }
}
