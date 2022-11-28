<?php

namespace App\Model\User\UseCase\SignUp\Request;

Use App\Model\Flusher;
Use App\Model\User\Entity\User\Id;
Use App\Model\User\Entity\User\Email;
Use App\Model\User\Entity\User\User;
Use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Service\ConfirmTokenSender;
Use App\Model\User\Service\PasswordHasher;
use App\Model\User\Service\SignUpConfirmTokenizer;

class Hadler
{
    private $users;
    private $hasher;
    private $tokenizer;
    private $sender;
    private $flusher;

    public function __construct(UserRepository $users, PasswordHasher $hasher,SignUpConfirmTokenizer $tokenizer, ConfirmTokenSender $sender, Flusher $flusher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if($this->users->hasByEmail($email)){
            throw new \DomainException('User already exists.');
        }

        $user = new User(
            Id::next(),
            new \DateTimeImmutable(),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->users->add($user);

        $this->sender->send($email, $token);

        $this->flusher->flush();
    }
}

