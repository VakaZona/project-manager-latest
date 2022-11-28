<?php

namespace App\Model\User\Entity\User;

use App\Model\User\Entity\User\Email;

class User
{
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

    public function __construct(Id $id, \DateTimeImmutable $date, Email $email, string $hash)
    {
        $this->id = $id;
        $this->date = $date;
        $this->email = $email;
        $this->passwordHash = $hash;
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
}
