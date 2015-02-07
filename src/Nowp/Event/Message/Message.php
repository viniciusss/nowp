<?php
/**
 *
 */

namespace Nowp\Event\Message;


use Nowp\Event\Event;

class Message
{
    /**
     * Content of the message
     * @var string
     */
    protected $content;
    /**
     * @var Author
     */
    protected $author;
    /**
     * Event that owns this message
     * @var Event
     */
    protected $event;

    function __construct($content, Author $author, Event $event)
    {
        $this->content = $content;
        $this->author =  $author;
        $this->event = $event;
    }

    function getContent()
    {
        return $this->content;
    }

    function getAuthor()
    {
        return $this->author;
    }

    function getEvent()
    {
        return $this->event;
    }
}