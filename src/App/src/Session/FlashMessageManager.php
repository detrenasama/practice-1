<?php

namespace App\Session;

class FlashMessageManager {
    protected $containers;

    public function __construct()
    {
        $this->containers = [];
        $initialData = isset($_SESSION[__CLASS__]) ? unserialize($_SESSION[__CLASS__]) : [];
        foreach ($initialData as $id => $container) {
            $c = new MessageContainer($id);
            error_log(var_export($container, true));
            foreach ($container as $message) {
                $c->push($message);
            }
            $this->register($c);
        }
    }

    public function has($containerId) {
        return isset($this->containers[$containerId]);
    }
    /**
     * @return MessageContainer
     */
    public function get($containerId) {
        if (!$this->has($containerId))
            $this->register(new MessageContainer($containerId));

        return $this->containers[$containerId];
    }
    public function register(MessageContainer $container) {
        $this->containers[$container->getId()] = $container;
    }

    public function __destruct()
    {
        $array = [];
        foreach ($this->containers as $container) {
            while (!$container->empty()) {
                $array[$container->getId()][] = $container->pop();
            }
        }
        $_SESSION[__CLASS__] = serialize($array);
    }
}