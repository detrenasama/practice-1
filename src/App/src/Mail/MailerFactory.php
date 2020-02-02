<?php

namespace App\Mail;

use Zend\ServiceManager\Factory\FactoryInterface;

class MailerFactory implements FactoryInterface{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $mailerConfig = $container->get('mailer');
        $mailer = new DumpMailer($mailerConfig);
        return $mailer;
    }
}