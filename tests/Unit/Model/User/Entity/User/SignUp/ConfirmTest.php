<?php

namespace App\Tests\Unit\Model\User\Entity\User\SignUp;


use PHPUnit\Framework\TestCase;
use App\Tests\Builder\User\UserBuilder;

class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->viaEmail()->build();

        $user->confirmSignUp();

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());

        self::assertNull($user->getConfirmToken());
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->viaEmail()->build();

       $user->confirmSignUp();
       $this->expectExceptionMessage('User is already confirmed');
       $user->confirmSignUp();
    }
}