<?php
/**
 *
 */

namespace Nowp\Event\Crew;


use Nowp\Event\Event;

interface AttendeeRepository
{
    /**
     * Finds an event membership
     *
     * @param $attendeeId
     * @return Attendee|null
     */
    function find($attendeeId);

    /**
     * Finds all people who REALLY attended to an event
     *
     * @param Event $event
     * @return Crew
     */
    function findAttendees(Event $event);
}