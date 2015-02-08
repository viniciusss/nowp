<?php
/**
 *
 */

namespace Nowp\Tests\Event\Crew;


use Nowp\Event\Crew\Membership;
use Nowp\Event\Event;
use Nowp\Tests\UnitTestCase;
use Nowp\User\User;

class MembershipTest extends UnitTestCase
{

    function testTurnAnItemAsAttended()
    {
        $item = new Membership(new User(), new Event());
        $item->attend();
        $this->assertTrue($item->getAttended());
    }
}
