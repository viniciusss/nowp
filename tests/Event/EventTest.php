<?php
/**
 *
 */

namespace Nowp\Tests\Event;

use Nowp\Common\Price;
use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\Common\Url;

class EventTest extends UnitTestCase
{
    function testInstantiateAnEvent()
    {
        new Event();
    }

    function setUp()
    {
        $this->eventName = 'event-name';
        $this->eventStartTime = \DateTime::createFromFormat('d/m/Y H:i', '10/04/2000 22:15');
        $this->eventManPrice = new Price();
        $this->eventWomanPrice = new Price();
        $this->eventDescription = 'A short description';
        $this->eventHashtag = $this->getMock('Nowp\\Common\\Hashtag');
        $this->eventLocation = $this->getMock('Nowp\\Location\\Location');
        $this->eventUrl = new Url('https://www.facebook.com/events/1579567718946519/');
    }

    function testCanConfigureEvent()
    {
        $event = new Event();
        $event->setName($this->eventName);
        $event->setStartTime($this->eventStartTime);
        $event->setManPrice($this->eventManPrice);
        $event->setWomanPrice($this->eventWomanPrice);
        $event->setDescription($this->eventDescription);
        $event->setHashtag($this->eventHashtag);
        $event->setLocation($this->eventLocation);
        $event->setLink($this->eventUrl);
        return $event;
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    function testSetNameMustThrowAnExceptionIfNoNameIsProvided()
    {
        $event = new Event();
        $event->setName('');
    }

    /**
     * @param Event $event
     * @depends testCanConfigureEvent
     */
    function testCanGetCorrectValuesThroughGetters($event)
    {
        $this->assertEquals($event->getName(), $this->eventName);
        $this->assertEquals($this->eventStartTime, $event->getStartTime());
        $this->assertEquals($this->eventManPrice, $event->getManPrice());
        $this->assertEquals($this->eventWomanPrice, $event->getWomanPrice());
        $this->assertEquals($this->eventDescription, $event->getDescription());
        $this->assertEquals($this->eventHashtag, $event->getHashtag());
        $this->assertEquals($this->eventLocation, $event->getLocation());
        $this->assertEquals($this->eventUrl, $event->getLink());
    }
}