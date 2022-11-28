<?php

namespace App\Model\User\UseCase\SignUp\Confirm;

Use App\Model\Flusher;
Use App\Model\User\Entity\User\UserRepository;


class Hadler
{
    private $users;
    private $flusher;

    public function __construct(UserRepository $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByConfirmToken($command->token)){
            throw new \DomainException('Uncorrect or confirmed token.');
        }

        $user->confirmSignUp();

        $this->flusher->flush();
    }
}

