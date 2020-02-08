<?php

use App\Session\MessageContainer;
use PHPUnit\Framework\TestCase;

class MessageContainerTest extends TestCase {
    /** @test */
    public function pushing_values_saved() {
        $c = new MessageContainer('test');
        $c->push('value');

        $this->assertEquals('value', $c->pop());

        $this->assertTrue($c->empty());
    }

    /** @test */
    public function pushing_multiple_values_pops_reverse_order() {
        $c = new MessageContainer('test');
        $c->push('value1');
        $c->push('value2');

        $this->assertEquals('value2', $c->pop());
        $this->assertEquals('value1', $c->pop());

    }
}