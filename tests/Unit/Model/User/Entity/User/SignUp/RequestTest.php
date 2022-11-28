<?php

namespace App\Tests\Unit\Model\User\Entity\User\SingUp;

use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase{
    public function testSuccess(): void
    {
        $user = new User(
            $id = Id::next(),
            $date = new \DateTimeImmutable(),
            $email = new Email('test@test.com'),
            $hash = 'hash',
            $token = 'token',
        );

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($token, $user->getConfirmToken());
    }
}