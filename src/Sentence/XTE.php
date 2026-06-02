<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\FixStatus;
use Leonrenkema\NmeaParser\Enums\ModeIndicator;
use Leonrenkema\NmeaParser\Enums\SteerDirection;

/**
 * XTE - Cross-track error.
 *
 * Contains cross-track error magnitude, steering direction, units, status, and
 * optional mode indicator for route-following navigation.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class XTE extends BaseSentence
{
    public ?FixStatus $status;

    public ?FixStatus $cycleLockStatus;

    public float $crossTrackErrorMagnitude;

    public ?SteerDirection $steerDirection;

    public string $units;

    public ?ModeIndicator $mode;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'([AV]),'
        .'([AV]),'
        .'([0-9\.]*),'
        .'(L|R)?,'
        .'([A-Z])'
        .'(?:,(A|D|E|N|S)?)?'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->status = FixStatus::tryFrom($matches[2]);
        $this->cycleLockStatus = FixStatus::tryFrom($matches[3]);
        $this->crossTrackErrorMagnitude = (float) $matches[4];
        $this->steerDirection = SteerDirection::tryFrom($matches[5]);
        $this->units = $matches[6];
        $this->mode = ModeIndicator::tryFrom($matches[7] ?? '');
    }
}
