<?php
/**
 *
 */

namespace Nowp\Tests\User;


use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\User\User;
use Nowp\User\Profile;
use Nowp\Event\Attendee;


class UserTest extends UnitTestCase
{
    /**
     * @var User
     */
    public $user;
    /**
     * @var Event
     */
    public $event;

    function setUp()
    {
        $this->user = new User();
        $this->event = new Event();
    }

    function testCanRetrieveTheUserProfile()
    {
        $profile = new Profile($this->user, new \DateTime('now'));
        $this->user->setProfile($profile);
        $this->assertSame($profile, $this->user->getProfile());
    }

    function testJoiningToAnEventMustReturnAnAttendeeInstance()
    {
        $this->assertInstanceOf(
            Attendee::class,
            $this->user->join($this->event)
        );
    }

    /**
     * @expectedException \Nowp\Event\Exception\TooManyAttendeesException
     */
    function testJoiningAnUserToAnEventThatHasTooManyAttendeesMustThrowAnException()
    {
        $this->event->setMaxAttendees(10);

        for ($i = 0; $i <= $this->event->getMaxAttendees(); $i++) {
            $this->event->joinUser(new User());
        }

        $this->user->join($this->event);
    }
}
