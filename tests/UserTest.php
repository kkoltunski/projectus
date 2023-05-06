<?php

namespace app\transfer;

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    /** @test */
    public function testClassConstructor()
    {
        $userPesel = 12345678901;
        $user = new User(array($userPesel, "X", "Y", "X@Y.com", "xxx", false));

        $this->assertSame($userPesel, $user->pesel);
    }
}