<?php

namespace App\Utils;

interface MailerProviderInterface
{
    public function send($email, $message);
}