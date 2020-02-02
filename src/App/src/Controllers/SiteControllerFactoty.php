<?php

namespace App\Controllers;

use App\Interfaces\MailerInterface;
use App\Session\FlashMessageManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class SiteControllerFactory implements FactoryInterface {
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $mailer = $container->get(MailerInterface::class);
        $flash = $container->get(FlashMessageManager::class);

        return new SiteController($mailer, $flash);
    }
}