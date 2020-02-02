<?php

use App\Session\FlashMessageManager;
use App\Session\MessageContainer;
use PHPUnit\Framework\TestCase;

class FlashMessageManagerTest extends TestCase {
    /** @test */
    public function getting_no_exist_container_returns_empty_container() {
        $flash = new FlashMessageManager();
        $this->assertInstanceOf(MessageContainer::class, $flash->get('test'));
    }

}