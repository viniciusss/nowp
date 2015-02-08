<?php
/**
 *
 */

namespace Nowp\Event\Crew;


use Nowp\Event\Event;
use Nowp\User\User;

class Membership
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var bool
     */
    protected $attended = false;
    /**
     * @var Event
     */
    protected $event;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var \DateTime
     */
    protected $joinTime;
    /**
     * @var \DateTime
     */
    protected $attendTime;


    function __construct(User $user, Event $event)
    {
        $this->event = $event;
        $this->user;
        $this->joinTime = new \DateTime('now');
    }

    function getId()
    {
        return $this->id;
    }

    function attend()
    {
        $this->attended = true;
    }

    function getAttended()
    {
        return $this->attended;
    }
}