<?php

namespace App\Mail;

use App\Interfaces\MailMessageInterface;

class MailMessage implements MailMessageInterface {
    protected $body;
    protected $subject;
    protected $to;
    protected $from;

    public function setBody($body) {
        $this->body = (string) $body;
    }
    public function setSubject($subject) {
        $this->subject = (string) $subject;
    }
    public function setTo(array $recipients) {
        $this->to = (array) $recipients;
    }
    public function setFrom($from) {
        $this->from = (string) $from;
    }

    public function getBody() {
        return $this->body;
    }
    public function getSubject() {
        return $this->subject;

    }
    public function getTo() {
        return $this->to;

    }
    public function getFrom() {
        return $this->from;
        
    }
}