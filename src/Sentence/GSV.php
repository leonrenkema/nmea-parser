<?php
declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Enums\Direction;
use Leonrenkema\NmeaParser\Enums\SystemMode;

class GSV extends BaseSentence
{
    public int $numberOfMessages;
    public int $sentenceNumber;
    public int $numberOfSatellites;

    protected string $frameRegex = '/^'
    . '([A-Z]{2}[A-Z]{3}),' //Equipment and trame type
    . '(\d*),' //Number of sentences for full data
    . '(\d*),' //Sentence number
    . '(\d*)' //Number of satellites in view
    . '(,(\d*),(\d*),(\d*),(\d*)' //Infos about first satellite
    . '(,(\d*),(\d*),(\d*),(\d*)' //Infos about second satellite
    . '(,(\d*),(\d*),(\d*),(\d*)' //Infos about trird satellite
    . '(,(\d*),(\d*),(\d*),(\d*)' //Infos about fourth satellite
    . ')?)?)?)?'
    . '$/m';

    protected function matchFields($matches): void
    {
        $this->numberOfMessages = (int)$matches[2];
        $this->numberOfSatellites = (int)$matches[4];
    }
}