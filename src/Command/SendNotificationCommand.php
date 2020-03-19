<?php

namespace App\Command;

use App\Entity\User;
use App\Provider\SesProvider;
use App\Service\NotificationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendNotificationCommand extends Command
{

    //Comando a ejecutar.
    protected static $defaultName = 'app:send-notification';

    protected function configure()
    {
        $this
            ->setDescription('Enviar notificación a un usuario.')
            ->setHelp('Comando para enviar notificación a un usuario.')
            ->addArgument('id', InputArgument::REQUIRED, 'Id del usuario.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        //Obtener el parámetro introducido.
        $input->getArgument('id');
        //Buscaríamos el usuario por ID. Como no disponemos de base de datos el constructor de la entidad creará uno por defecto.
        $user = new User();

        $provider = new SesProvider();
        $service = new NotificationService($provider);
        $message = "Notificación enviada por consola.";
        $result = $service->notify($user, $message);

        //Mostrar el resultado.
        $resultBoolean = ($result) ? 'true' : 'false';
        $output->writeln("id: {$user->getId()}");
        $output->writeln("email: {$user->getEmail()}");
        $output->writeln("message: {$message}");
        $output->writeln("result: {$resultBoolean}");

        //En Symfony 5, es obligatorio devolver el estado de salida. Devolvemos el valor en integer del resultado.
        return intval($result);
    }
}