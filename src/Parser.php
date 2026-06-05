<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser;

use Exception;
use Leonrenkema\NmeaParser\Exceptions\ChecksumInvalidException;
use Leonrenkema\NmeaParser\Sentence\APB;
use Leonrenkema\NmeaParser\Sentence\BaseSentence;
use Leonrenkema\NmeaParser\Sentence\BOD;
use Leonrenkema\NmeaParser\Sentence\BWC;
use Leonrenkema\NmeaParser\Sentence\DBT;
use Leonrenkema\NmeaParser\Sentence\DPT;
use Leonrenkema\NmeaParser\Sentence\GBS;
use Leonrenkema\NmeaParser\Sentence\GGA;
use Leonrenkema\NmeaParser\Sentence\GLL;
use Leonrenkema\NmeaParser\Sentence\GSA;
use Leonrenkema\NmeaParser\Sentence\GST;
use Leonrenkema\NmeaParser\Sentence\GSV;
use Leonrenkema\NmeaParser\Sentence\HDG;
use Leonrenkema\NmeaParser\Sentence\HDM;
use Leonrenkema\NmeaParser\Sentence\HDT;
use Leonrenkema\NmeaParser\Sentence\MTW;
use Leonrenkema\NmeaParser\Sentence\MWV;
use Leonrenkema\NmeaParser\Sentence\ROT;
use Leonrenkema\NmeaParser\Sentence\RMB;
use Leonrenkema\NmeaParser\Sentence\RMC;
use Leonrenkema\NmeaParser\Sentence\RTE;
use Leonrenkema\NmeaParser\Sentence\TXT;
use Leonrenkema\NmeaParser\Sentence\VHW;
use Leonrenkema\NmeaParser\Sentence\VLW;
use Leonrenkema\NmeaParser\Sentence\VTG;
use Leonrenkema\NmeaParser\Sentence\WPL;
use Leonrenkema\NmeaParser\Sentence\XTE;
use Leonrenkema\NmeaParser\Sentence\ZDA;

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
            'APB' => APB::class,
            'BOD' => BOD::class,
            'BWC' => BWC::class,
            'DBT' => DBT::class,
            'DPT' => DPT::class,
            'GBS' => GBS::class,
            'GGA' => GGA::class,
            'GSV' => GSV::class,
            'GLL' => GLL::class,
            'GSA' => GSA::class,
            'GST' => GST::class,
            'HDG' => HDG::class,
            'HDM' => HDM::class,
            'HDT' => HDT::class,
            'MTW' => MTW::class,
            'MWV' => MWV::class,
            'ROT' => ROT::class,
            'RMB' => RMB::class,
            'RMC' => RMC::class,
            'RTE' => RTE::class,
            'TXT' => TXT::class,
            'VHW' => VHW::class,
            'VLW' => VLW::class,
            'VTG' => VTG::class,
            'WPL' => WPL::class,
            'XTE' => XTE::class,
            'ZDA' => ZDA::class,
            default => throw new Exception(sprintf('Unsupported sentence type "%s".', $matches[4])),
        };

        if ($matches[1] && $matches[5]) {
            $sentence = new $class;
            $sentence->parse($matches[1], $matches[5]);

            return $sentence;
        }
        throw new Exception('The detection of the frame type has failed.');
    }
}
