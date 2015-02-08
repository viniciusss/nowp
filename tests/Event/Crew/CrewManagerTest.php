<?php
/**
 *
 */

namespace Nowp\Tests\Event\Crew;


use Nowp\Event\Crew\Crew;
use Nowp\Event\Crew\Membership;
use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\Event\Crew\CrewRepository;
use Nowp\Event\Crew\CrewManager;
use Nowp\User\User;

class CrewManagerTest extends UnitTestCase
{
    /**
     * @var
     */
    public $membershipRepository;
    /**
     * @var CrewManager
     */
    public $crewManager;
    /**
     * @var User
     */
    public $user;
    /**
     * @var Event
     */
    public $event;
    /**
     * @var int
     */
    public $maxAttendees = 10;

    function setUp()
    {
        $this->user = new User();
        $this->event = new Event();
        $this->event->setMaxAttendees($this->maxAttendees);

        $this->membershipRepository = $this->getMockBuilder('\\Nowp\\Event\\Crew\\MembershipRepository')->getMock();
        $this->crewManager = new CrewManager($this->membershipRepository);
    }

    function testJoiningAnUserToAnEventMustReturnAMembershipInstance()
    {
        $this->membershipRepository->expects($this->once())
            ->method('findAttendees')
            ->will($this->returnValue($this->getAttendeeList($this->event)))
        ;

        $this->crewManager = new CrewManager($this->membershipRepository);

        $this->assertInstanceOf(
            Membership::class,
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
        $membership = new Membership($this->user, $this->event);
        $repositoryMock = $this->getMockBuilder('\\Nowp\\Event\\Crew\\MembershipRepository')->getMock();
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
        $repositoryMock = $this->getMockBuilder('\\Nowp\\Event\\Crew\\MembershipRepository')->getMock();
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
            $membership[$i] = new Membership(new User(), $event);
            $membership[$i]->attend();
        }
        return new Crew($membership);
    }
}