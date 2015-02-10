<?php
/**
 *
 */

namespace Nowp\Tests\User;


use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\User\User;
use Nowp\User\Profile;


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

    function testJoiningAnUserToAnEventMustReturnAMembershipInstance()
    {
        $this->membershipRepository->expects($this->once())
            ->method('findAttendees')
            ->will($this->returnValue($this->getAttendeeList($this->event)))
        ;

        $this->crewManager = new CrewManager($this->membershipRepository);

        $this->assertInstanceOf(
            Attendee::class,
            $this->crewManager->joinUserToEvent($this->user, $this->event)
        );
    }

    /**
     * @expectedException \Nowp\Event\Exception\MaxAttendeesException
     */
    function testJoiningAnUserToAnEventThatHasTooManyAttendeesMustThrowAnException()
    {
        $userTryingToJoin = new User();

        $this->membershipRepository->expects($this->once())
            ->method('findAttendees')
            ->will($this->returnValue($this->getAttendeeList($this->event, $this->maxAttendees)))
        ;

        $this->crewManager = new CrewManager($this->membershipRepository);
        $this->crewManager->joinUserToEvent($userTryingToJoin, $this->event);
    }

    function testSizeOfCrewShouldIncreaseAfterJoiningAnEvent()
    {
        $crew = $this->event->getCrew()->count();

        $this->membershipRepository->expects($this->once())
            ->method('findAttendees')
            ->will($this->returnValue($this->getAttendeeList($this->event)))
        ;
        $this->crewManager = new CrewManager($this->membershipRepository);

        $this->crewManager->joinUserToEvent($this->user, $this->event);
        $this->assertGreaterThan($crew, $this->event->getCrew()->count());
    }

    function testSetMembershipAttendedSetTheMembershipAsAttended()
    {
        $membership = new Attendee($this->user, $this->event);

        $repositoryMock = $this->getMockBuilder(AttendeeRepository::class)->getMock();
        $repositoryMock->expects($this->once())
            ->method('find')
            ->will($this->returnValue($membership))
        ;

        $this->crewManager = new CrewManager($repositoryMock);
        $this->assertTrue($this->crewManager->setMembershipAttended(1)->getAttended());
    }

    /**
     * @expectedException \Nowp\Event\Crew\Exception\MembershipNotFoundException
     */
    function testShouldThrowExceptionWhenMembershipDoesNotExists()
    {
        $repositoryMock = $this->getMockBuilder(AttendeeRepository::class)->getMock();
        $repositoryMock->expects($this->once())
            ->method('find')
            ->will($this->returnValue(null))
        ;

        $this->crewManager = new CrewManager($repositoryMock);
        $this->crewManager->setMembershipAttended(999);
    }

    private function getAttendeeList(Event $event, $size = 5)
    {
        for ($i = 0; $i <= $size; $i++) {
            $membership[$i] = new Attendee(new User(), $event);
            $membership[$i]->attend();
        }
        return new Crew($membership);
    }
}
