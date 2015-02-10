<?php
/**
 *
 */

namespace Nowp\Tests\Event\Crew;


use Nowp\Event\Attendee;
use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\User\User;

class AttendeeTest extends UnitTestCase
{
    function testCanArriveToAnEvent()
    {
        $attendee = new Attendee(new User(), new Event());
        $attendee->arrive();
        $this->assertTrue($attendee->hasArrived());
    }

    function testCanLeaveAnEvent()
    {
        $attendee = new Attendee(new User(), new Event());
        $attendee->arrive();
        $attendee->leave();
        $this->assertTrue($attendee->hasArrived());
    }

    /**
     * @expectedException \Nowp\Event\Exception\NotAttendedYetException
     * @expectedExceptionMessage "Cannot leave an event without arriving there"
     */
    function testLeavingAnEventWithoutAttendingItMustThrowAnException()
    {
        $attendee = new Attendee(new User(), new Event());
        $attendee->leave();
    }

    /**
     * @expectedException \Nowp\Event\Exception\ArrivingToSameEventWithoutLeavingException
     */
    function testAnAttendeeCannotArriveToAnEventWhereHeIsAlreadyIn()
    {
        $event = new Event();
        $user = new User();
        $attendee = new Attendee($user, $event);
        $attendee->arrive();
        $attendee->arrive();
    }
}
