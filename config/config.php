<?php

use App\Controllers\SiteController;
use App\Controllers\SiteControllerFactory;
use App\Interfaces\MailerInterface;
use App\Mail\MailerFactory;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'abstract_factories' => [
        ReflectionBasedAbstractFactory::class,
    ],
    'factories' => [
        MailerInterface::class => MailerFactory::class,
        // SiteController::class => SiteControllerFactory::class,
    ],
    
    'services' => [
        'mailer' => [
            'from' => 'info@mysite.com',
            'to' => [
                'support@mysite.com'
            ],
            'mailbox_directory' => dirname(__DIR__) . '/var/mail/out',
        ]
    ],
    
];