<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

use Leonrenkema\NmeaParser\Exceptions\ChecksumInvalidException;

abstract class BaseSentence
{
    protected string $frameRegex = '';

    public string $constellation;

    /**
     * @param  array<string>  $matches
     */
    abstract protected function matchFields(array $matches): void;

    /**
     * @throws ChecksumInvalidException
     */
    public function parse(string $sentence, string $checksum): void
    {
        $this->checksum($sentence, $checksum);

        preg_match($this->frameRegex, $sentence, $matches);

        $this->matchFields($matches);
    }

    /**
     * @throws ChecksumInvalidException
     */
    protected function checksum(string $sentence, string $checksumFromSentence): void
    {
        $nbCharInMsg = strlen($sentence);
        $checksum = 0;

        for ($readedChar = 0; $readedChar < $nbCharInMsg; $readedChar++) {
            $checksum ^= ord($sentence[$readedChar]);
        }

        if ($checksum < 16) {
            $checksum = '0'.dechex($checksum);
        } else {
            $checksum = dechex($checksum);
        }

        if (strtoupper($checksum) !== strtoupper($checksumFromSentence)) {
            throw new ChecksumInvalidException(
                'The line is corrupted. The checksum not corresponding.'
            );
        }
    }
}
