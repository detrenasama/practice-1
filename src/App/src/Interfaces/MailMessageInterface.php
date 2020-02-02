<?php

namespace App\Interfaces;

interface MailMessageInterface {
    public function setBody($body);
    public function setSubject($subject);
    public function setTo(array $recipients);
    public function setFrom($from);

    public function getBody();
    public function getSubject();
    public function getTo();
    public function getFrom();
}