<?php

declare(strict_types=1);

namespace Leonrenkema\NmeaParser\Sentence;

/**
 * TXT - Text transmission.
 *
 * Contains numbered text messages from a receiver, commonly used for receiver
 * notices, status text, or vendor-provided informational messages.
 *
 * @see https://w3.cs.jmu.edu/bernstdh/web/common/help/nmea-sentences.php
 */
class TXT extends BaseSentence
{
    public int $totalMessages;

    public int $messageNumber;

    public int $messageType;

    public string $text;

    protected string $frameRegex = '/^'
        .'([A-Z]{2}[A-Z]{3}),'
        .'(\d*),'
        .'(\d*),'
        .'(\d*),'
        .'(.*)'
        .'$/m';

    protected function matchFields(array $matches): void
    {
        $this->totalMessages = (int) $matches[2];
        $this->messageNumber = (int) $matches[3];
        $this->messageType = (int) $matches[4];
        $this->text = $matches[5];
    }
}
