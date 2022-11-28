<?php

namespace App\Model\User\Entity\User;

use App\Model\User\Entity\User\Email;

class User
{
    private const STATUS_WAIT = 'wait';
    private const STATUS_ACTIVE = 'active';
    /**
     * id
     *
     * @var Id
     */
    private $id;

    /**
     * date
     *f
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * email
     *
     * @var Email
     */    
    
    private $email;

    /**
     * passwordHash
     *
     * @var string
     */
    private $passwordHash;    
    /**
     * confirmToken
     *
     * @var string|null
     */
    private $confirmToken;    
    /**
     * status
     *
     * @var string
     */
    private $status;

    public function __construct(Id $id, \DateTimeImmutable $date, Email $email, string $hash, string $token)
    {
        $this->id = $id;
        $this->date = $date;
        $this->email = $email;
        $this->passwordHash = $hash;
        $this->confirmToken = $token;
        $this->status = self::STATUS_WAIT;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getId(): Id
    {
        return $this->id;
    }
    
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getConfirmToken(): string
    {
        return $this->confirmToken;
    }
    
    public function confirmSignUp(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already confirmed.');
        }

        $this->status = self::STATUS_ACTIVE;
        $this->confirmToken = null;
    }
}
