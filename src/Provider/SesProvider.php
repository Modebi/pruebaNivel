<?php

namespace App\Provider;

use App\Utils\MailerProviderInterface;

class SesProvider implements MailerProviderInterface
{

    public function send($email, $message)
    {
        return false;
    }
}