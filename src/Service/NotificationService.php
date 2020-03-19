<?php

namespace App\Service;

use App\Entity\User;

class NotificationService
{

    protected $provider;

    /**
     * NotificationService constructor.
     * @param $provider
     */
    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    public function notify(User $user, $message): bool {
        return $this->provider->send($user->getEmail(), $message);
    }

}
