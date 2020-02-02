<?php

namespace App\Controllers;

use App\Interfaces\MailerInterface;
use App\Mail\MailMessage;
use App\Session\FlashMessageManager;

class SiteController {
    private $mailer;
    private $flash;

    public function __construct(MailerInterface $mailer, FlashMessageManager $flash)
    {
        $this->mailer = $mailer;
        $this->flash = $flash;
    }

    public function actionIndex() {

        $errors = $this->flash->has('errors') ? $this->flash->get('errors') : null;

        include_once("pages/home.php");
    }

    public function actionForm() {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        $obMess = new MailMessage();
        $obMess->setBody(sprintf("Hi! New message from site!\n\nName: %s\nEmail: %s\nMessage:\n%s", 
            $name,
            $email,
            $message
        ));
        $obMess->setSubject("Message from my site");

        try {
            $this->mailer->send($obMess);

            header('Location: /form/success');
            exit();
        } catch (\Exception $e) {
            
            $c = $this->flash->get('errors');
            $c->push($e->getMessage());

            header('Location: /');
            exit();
        }
    }

    public function actionFormSuccess() {
        include_once("pages/form.success.php");
    }
}