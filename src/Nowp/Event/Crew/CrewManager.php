<?php
/**
 *
 */

namespace Nowp\Event\Crew;


use Nowp\Event\Crew\Exception\MembershipNotFoundException;
use Nowp\Event\Event;
use Nowp\Event\Exception\MaxAttendeesException;
use Nowp\User\User;

class CrewManager
{
    /**
     * @var MembershipRepository
     */
    protected $membershipRepository;

    function __construct(MembershipRepository $membershipRepository)
    {
        $this->membershipRepository = $membershipRepository;
    }

    /**
     * Join an user to an event
     *
     * @param User $user
     * @param Event $event
     * @return Membership
     */
    function joinUserToEvent(User $user, Event $event)
    {
        $crew = $event->getCrew();
        $attendees = $this->membershipRepository->findAttendees($event);

        if ($attendees->count() > $event->getMaxAttendees()) {
            throw new MaxAttendeesException('Cannot join this event because it is full');
        }

        $member = new Membership($user, $event);
        $crew->add($member);

        return $member;
    }

    /**
     * @param $membershipId
     * @return Membership|null
     */
    function setMembershipAttended($membershipId)
    {
        $membership = $this->membershipRepository->find($membershipId);

        if ($membership === null) {
            throw new MembershipNotFoundException("Membership not found");
        }

        $membership->attend();

        return $membership;
    }
}