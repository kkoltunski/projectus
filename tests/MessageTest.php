<?php

namespace core;

use PHPUnit\Framework\TestCase;

final class MessageTest extends TestCase
{
    /** @test */
    public function checkIfMessageIsAsExpected()
    {
        $infoTxt = "info msg";
        $warningTxt = "wrn msg";
        $errorTxt = "error msg";

        $infoMsg = new Message($infoTxt, Message::INFO);
        $warningMsg = new Message($warningTxt, Message::WARNING);
        $errorMsg = new Message($errorTxt, Message::ERROR);

        $this->assertSame($infoTxt, $infoMsg->text);
        $this->assertSame(Message::INFO, $infoMsg->type);

        $this->assertSame($warningTxt, $warningMsg->text);
        $this->assertSame(Message::WARNING, $warningMsg->type);

        $this->assertSame($errorTxt, $errorMsg->text);
        $this->assertSame(Message::ERROR, $errorMsg->type);
    }
}