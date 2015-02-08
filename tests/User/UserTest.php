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
}
