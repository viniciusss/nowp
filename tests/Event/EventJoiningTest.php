<?php
/**
 *
 */

namespace Nowp\Tests\Event;

use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\User\User;
use Nowp\Event\Member;

class EventJoiningTest extends UnitTestCase
{

    /**
     * @var Event
     */
    public $event;

    /**
     * @var User
     */
    public $user;

    function setUp()
    {
        $this->event = new Event();
        $this->event->setMaxAttendees(4);
        $this->user = new User;
    }

    function testNumberOfMembersShouldIncreaseAfterJoiningAnEvent()
    {
        $members = $this->event->getMembers()->count();
        $this->user->joinEvent($this->event);
        $this->assertGreaterThan($members, $this->event->getMembers()->count());
    }


    function testJoiningAnEventShouldReturnAMemberInstance()
    {
        $this->assertInstanceOf(Member::class, $this->user->joinEvent($this->event));
    }

    /**
     * @expectedException \Nowp\Event\Exception\MaxAttendeesException
     */
    function testShouldThrowAnExceptionWhenMaxOfAttendeeIsReached()
    {
        for ($i = 0; $i <= 10; $i++) {
            $user = new User;
            $user->joinEvent($this->event);
        }
    }
}
