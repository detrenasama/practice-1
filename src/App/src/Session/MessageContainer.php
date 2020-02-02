<?php

namespace App\Session;

class MessageContainer {

    protected $id;
    protected $messages;

    public function __construct($containerId)
    {
        $this->id = $containerId;
        $this->messages = new \SplStack;
    }

    public function getId() {
        return $this->id;
    }

    public function push($message) {
        $this->messages->push($message);
    }
    public function pop() {
        return $this->messages->pop();
    }
    public function empty() {
        return $this->messages->isEmpty();
    }
}