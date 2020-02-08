<?php

namespace App\Mail;

use App\Interfaces\MailerInterface;
use App\Interfaces\MailMessageInterface;

class DumpMailer implements MailerInterface {

    protected $from;
    protected $to;

    protected $dir;

    public function __construct($config = [])
    {
        $options = $config['options'];
        $this->from = $options['from'] ?: null;        
        $this->to = $options['to'] ?: null;        

        $this->dir = $options['mailbox_directory'] ?: 'var/mail/outbox';
    }

    public function send(MailMessageInterface $message) {
        if (!$message->getSubject())
            throw new \Exception("Subject is required!");

        $headers = [];
        $headers['FROM'] = $message->getFrom() ?: $this->from;
        $headers['RECIPIENTS'] = $message->getTo() ? join(', ', $message->getTo()) : join(', ', $this->to);
        $headers['SUBJECT'] = $message->getSubject();
        
        $body = $message->getBody();

        if (!$this->dir || !is_dir($this->dir)) {
            mkdir($this->dir, 0755, true);
        }

        $f = fopen($this->dir . '/' . time() .'.mail', 'w');
        if (!$f)
            throw new \Exception("Cannot write to file!");

        try {
            $head = "";
            foreach ($headers as $header => $value) {
                $head .= "{$header}: {$value}\n";
            }

            fwrite($f, $head . "\n" . $body);
        } finally {
            fclose($f);
        }
    }
}