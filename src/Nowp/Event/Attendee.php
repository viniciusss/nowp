<?php
/**
 *
 */

namespace Nowp\Event;


use Nowp\Event\Exception\AlreadyOnTheEventException;
use Nowp\User\User;
use Nowp\Event\Exception\NotArrivedYetException;

class Attendee
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var bool
     */
    protected $hasArrived = false;
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

    function arrive()
    {
        if ($this->hasArrived) {
            throw new AlreadyOnTheEventException();
        }
        $this->hasArrived = true;
    }

    function hasArrived()
    {
        return $this->hasArrived;
    }


    function leave()
    {
        if (!$this->hasArrived()) {
            throw new NotArrivedYetException();
        }
    }
}