<?php


namespace Leonrenkema\Parser;

use Leonrenkema\NmeaParser\CoordinateConverter;
use Leonrenkema\NmeaParser\Enums\Direction;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CoordinateConverterTest extends TestCase
{
    #[Test]
    public function test(): void
    {
        $converter = new CoordinateConverter();

        $decimal = $converter->nmeaToDecimal(5158.34572, Direction::North);

        $this->assertSame(51.972429, $decimal);
        $dms = $converter->decimalToDMS($decimal);
        $this->assertSame('{"degrees":51,"minutes":58,"seconds":20.74}', json_encode($dms));

        $decimal = $converter->nmeaToDecimal(553.72838, Direction::East);
        $this->assertSame(5.895473, $decimal);
        $dms = $converter->decimalToDMS($decimal);
        $this->assertSame('{"degrees":5,"minutes":53,"seconds":43.7}', json_encode($dms));
    }

    #[Test]
    public function support_southern_hemisphere(): void
    {
        $converter = new CoordinateConverter();

        $decimal = $converter->nmeaToDecimal(5158.34572, Direction::South);

        $this->assertSame(-51.972429, $decimal);
        $dms = $converter->decimalToDMS($decimal);
        $this->assertSame('{"degrees":51,"minutes":58,"seconds":20.74,"direction":"N"}', json_encode($dms)); //todo

        $decimal = $converter->nmeaToDecimal(553.72838, Direction::West);
        $this->assertSame(-5.895473, $decimal);
        $dms = $converter->decimalToDMS($decimal);
        $this->assertSame('{"degrees":5,"minutes":53,"seconds":43.7,"direction":"N"}', json_encode($dms));
    }
}
