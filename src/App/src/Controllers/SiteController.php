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
        $inputs = $this->flash->has('inputs') ? $this->flash->get('inputs') : null;

        $userInput = [];
        if ($inputs) {
            while (!$inputs->empty()) {
                $arVal = $inputs->pop();
                $userInput[$arVal[0]] = $arVal[1];
            }
        }

        include_once("pages/home.php");
    }

    public function actionForm() {
        try {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);

            $inputs = $this->flash->get('inputs');
            $inputs->push(['name', $name]);
            $inputs->push(['email', $email]);
            $inputs->push(['message', $message]);

            if (!$email)
                throw new \Exception("Заполните email!");

            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                throw new \Exception("Неверный email!");

            $obMess = new MailMessage();
            $obMess->setBody(sprintf("Hi! New message from site!\n\nName: %s\nEmail: %s\nMessage:\n%s", 
                $name,
                $email,
                $message
            ));
            $obMess->setSubject("Message from my site");

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