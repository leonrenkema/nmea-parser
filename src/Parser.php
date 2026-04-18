<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser;

use Exception;
use Leonrenkema\NmeaParser\Exceptions\ChecksumInvalidException;
use Leonrenkema\NmeaParser\Sentence\BaseSentence;
use Leonrenkema\NmeaParser\Sentence\GLL;
use Leonrenkema\NmeaParser\Sentence\GSV;
use Leonrenkema\NmeaParser\Sentence\RMC;
use Leonrenkema\NmeaParser\Sentence\VTG;

class Parser
{
    /**
     * @throws ChecksumInvalidException
     */
    public function parse(string $line): BaseSentence
    {
        $matches = [];
        if (! preg_match('/^\$((([A-Z]{2})([A-Z]{3})),.*)\*([A-Z0-9]{2})/', $line, $matches)) {
            throw new Exception(
                'The detection of the frame type has failed.'
            );
        }

        $class = match ($matches[4]) {
            'GSV' => GSV::class,
            'GLL' => GLL::class,
            'RMC' => RMC::class,
            'VTG' => VTG::class,
            // default => throw new Exception()
        };

        if ($matches[1] && $matches[5]) {
            $sentence = new $class;
            $sentence->parse($matches[1], $matches[5]);

            return $sentence;
        }

        throw new Exception;
    }
}
