<?php
/**
 *
 */

namespace Nowp\Tests\Event\Message;


use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\Event\Message\Message;
use Nowp\Event\Message\Author;

class MessageTest extends UnitTestCase
{
    public $event, $author;

    function setUp()
    {
        $this->event = new Event();
        $this->author = $this->getMock(Author::class);
    }

    function testCanRetrieveMessageData()
    {
        $message = new Message('message content', $this->author, $this->event);
        $this->assertEquals('message content', $message->getContent());
        $this->assertEquals($this->author, $message->getAuthor());
        $this->assertEquals($this->event, $message->getEvent());
    }
}
