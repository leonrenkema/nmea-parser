<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser;

use Exception;
use Leonrenkema\NmeaParser\Sentence\BaseSentence;
use Leonrenkema\NmeaParser\Sentence\GLL;
use Leonrenkema\NmeaParser\Sentence\GSV;

class Parser
{

    public function parse(string $line): BaseSentence
    {
        $matches = [];
        if (!preg_match('/^\$([A-Z]{2})([A-Z]{3}),/', $line, $matches)) {
            throw new Exception(
                'The detection of the frame type has failed.'
            );
        }

        $matched = [];
        if (!preg_match('/^\$(.*)\*([A-Z0-9]{2})/', $line, $matched)) {

        }

        print_r($matches);
        print_r($matched);

        $class = match ($matches[2]) {
            'GSV' => GSV::class,
            'GLL' => GLL::class,
            default => throw new Exception()
        };

        if ($matched[1] && $matched[2]) {
            $sentence = new $class();
            $sentence->parse($matched[1], $matched[2]);
            return $sentence;
        }

        throw new Exception();
    }
}