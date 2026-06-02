<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * RTE - Route waypoint list.
 *
 * Contains route message sequencing, route mode, and the ordered waypoint
 * identifiers that make up a route.
 *
 * @see https://www8.garmin.com/manuals/webhelp/gpsmap8400-8600/EN-US/GUID-891D6EC7-169E-4146-8279-8400626217D0.html
 */
class RTE extends BaseSentence
{
    public int $numberOfMessages;

    public int $messageNumber;

    public string $messageMode;

    /** @var array<int, string> */
    public array $waypointIds;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'(\d*),'
        .'(\d*),'
        .'([cw]),'
        .'(.*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->numberOfMessages = (int) $matches[2];
        $this->messageNumber = (int) $matches[3];
        $this->messageMode = $matches[4];
        $this->waypointIds = array_values(array_filter(explode(',', $matches[5]), fn (string $id): bool => $id !== ''));
    }
}
