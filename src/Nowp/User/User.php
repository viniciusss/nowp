<?php
/**
 *
 */

namespace Nowp\User;


use Nowp\Event\Event;
use Nowp\Event\EventCrew;
use Nowp\Event\EventCrewItem;
use Nowp\Event\Exception\MaxAttendeesException;
use Nowp\Event\Member;

class User
{
    /**
     * @var Profile
     */
    protected $profile;

    function __construct()
    {
        $this->events = new EventList();
    }

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




    function getEvents()
    {
        return $this->events;
    }
}