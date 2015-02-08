<?php
/**
 *
 */

namespace Nowp\User;


use Nowp\Event\Event;
use Nowp\Event\Exception\MaxAttendeesException;
use Nowp\Event\Member;

class User
{
    /**
     * @var Profile
     */
    protected $profile;

    /**
     * Sets the user profile
     * @param Profile $profile
     */
    function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get the user profile
     * @return Profile
     */
    function getProfile()
    {
        return $this->profile;
    }


    /**
     * Allows an User to join an Event
     * @param Event $event
     * @return Member
     */
    function joinEvent(Event $event)
    {
        $members = $event->getMembers();

        if ($members->count() > $event->getMaxAttendees()) {
            throw new MaxAttendeesException('Cannot join this event because it is full');
        }

        $newMember = new Member($event, $this);
        $members->add($this);
        return $newMember;
    }
}