<?php

namespace App\Controller;

use App\Entity\User;
use App\Provider\SmtpProvider;
use App\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users/send_notification/{id}", name="users_send_notification")
     */
    public function sendNotification(int $id)
    {
        //Buscaríamos el usuario por ID. Como no disponemos de base de datos el constructor de la entidad creará uno por defecto.
        $user = new User();

        $provider = new SmtpProvider();
        $service = new NotificationService($provider);
        $message = "Este es un mensaje de prueba.";
        $result = $service->notify($user, $message);

        //Respuesta.
        return $this->json(array(
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'message' => $message,
            'result' => $result
        ));
    }
}
