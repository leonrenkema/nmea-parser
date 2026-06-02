<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * ZDA - UTC time and date.
 *
 * Contains UTC time, day, month, year, and local time zone offset fields.
 *
 * @see https://w3.cs.jmu.edu/bernstdh/web/common/help/nmea-sentences.php
 */
class ZDA extends BaseSentence
{
    public string $time;

    public int $day;

    public int $month;

    public int $year;

    public int $localZoneHours;

    public int $localZoneMinutes;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),' // Equipment and trame type
        .'(\d{6})(\.\d{2,3})?,' // Time (UTC)
        .'(\d{2}),' // Day
        .'(\d{2}),' // Month
        .'(\d{4}),' // Year
        .'([+-]?\d{1,2}),' // Local zone hours
        .'(\d{2})' // Local zone minutes
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->time = $matches[2].($matches[3] ?? '');
        $this->day = (int) $matches[4];
        $this->month = (int) $matches[5];
        $this->year = (int) $matches[6];
        $this->localZoneHours = (int) $matches[7];
        $this->localZoneMinutes = (int) $matches[8];
    }
}
