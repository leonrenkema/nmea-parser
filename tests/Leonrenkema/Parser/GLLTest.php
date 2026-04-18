<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\ModeIndicator;
use Leonrenkema\NmeaParser\Parser;
use Leonrenkema\NmeaParser\Sentence\GLL;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GLLTest extends TestCase
{
    #[Test]
    #[DataProvider('example')]
    public function test_example_sentences(string $line, array $expected): void
    {
        $parser = new Parser;
        /** @var GLL $sentence */
        $sentence = $parser->parse($line);

        $this->assertSame($expected['longitude'], $sentence->longitude);
        $this->assertSame($expected['latitude'], $sentence->latitude);
        $this->assertSame($expected['status'], $sentence->status);
        $this->assertSame($expected['mode'], $sentence->mode);
    }

    public static function example(): array
    {
        return [
            [
                '$GPGLL,5158.34146,N,00553.71640,E,190003.00,A,A*68', [
                    'latitude' => '5158.34146',
                    'longitude' => '00553.71640',
                    'status' => FixStatus::Active,
                    'mode' => ModeIndicator::Autonomous,
                ]],
            [
                '$GPGLL,,,,,162413.00,V,N*49', [
                    'longitude' => '',
                    'latitude' => '',
                    'status' => FixStatus::Void,
                    'mode' => ModeIndicator::NotValid,
                ]],
        ];
    }
}
