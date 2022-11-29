<?php

namespace App\Tests\Unit\Model\User\Entity\User\SingUp;

use PHPUnit\Framework\TestCase;
use App\Model\User\Entity\User\Email;
use App\Tests\Builder\User\UserBuilder;

class RequestTest extends TestCase{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->signUpByEmail(
            $email = new Email('test@app.test'),
            $hash = 'hash',
            $token = 'token'
        );

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());

        self::assertEquals($token, $user->getConfirmToken());
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->build();

        $user->signUpByEmail(
            $email = new Email('test@app.test'),
            $hash = 'hash',
            $token = 'token'
        );

        $this->expectExceptionMessage('User is already signed up.');

        $user->signUpByEmail($email, $hash, $token);
    }
}