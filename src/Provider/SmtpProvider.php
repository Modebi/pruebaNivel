<?php

namespace App\Provider;

use App\Utils\MailerProviderInterface;

class SmtpProvider implements MailerProviderInterface
{

    public function send($email, $message)
    {
        return true;
    }
}