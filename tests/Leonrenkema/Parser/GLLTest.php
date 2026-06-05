<?php

namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\Enums\Direction;
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
    /**
     * @param  array{latitude: string, longitude: string, status: FixStatus, mode: ModeIndicator}  $expected
     */
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

    #[Test]
    public function test_gll_sentence(): void
    {
        $parser = new Parser;
        /** @var GLL $sentence */
        $sentence = $parser->parse('$GPGLL,5158.34572,N,00553.72838,E,053949.00,A,A*60');

        $this->assertSame(ModeIndicator::Autonomous, $sentence->mode);
        $this->assertSame('5158.34572', $sentence->latitude);
        $this->assertSame(Direction::North, $sentence->latitudeDirection);
        $this->assertSame(Direction::East, $sentence->longitudeDirection);
        $this->assertSame('00553.72838', $sentence->longitude);
    }

    /**
     * @return array<int, array{0: string, 1: array{latitude: string, longitude: string, status: FixStatus, mode: ModeIndicator}}>
     */
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
