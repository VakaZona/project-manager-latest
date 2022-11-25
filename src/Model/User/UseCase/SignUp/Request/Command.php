<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;

class Command
{

    /**
     * email
     *
     * @var string
     */
    public $email;

    /**
     * password
     *
     * @var string
     */
    public $password;
}
