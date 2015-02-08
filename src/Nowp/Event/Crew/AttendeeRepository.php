<?php
/**
 *
 */

namespace Nowp\Event\Crew;


use Nowp\Event\Event;

interface MembershipRepository
{
    /**
     * Finds an event membership
     *
     * @param $membershipId
     * @return Membership|null
     */
    function find($membershipId);

    /**
     * Finds all people who REALLY attended to an event
     *
     * @param Event $event
     * @return Crew
     */
    function findAttendees(Event $event);
}