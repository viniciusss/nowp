<?php
/**
 *
 */

namespace Nowp\Tests\User;


use Nowp\Tests\UnitTestCase;
use Nowp\User\User;
use Nowp\User\Profile;


class UserTest extends UnitTestCase
{

    function testCanCreateAnUser()
    {
        new User();
    }

    function testCanRetrieveTheUserProfile()
    {
        $user = new User();
        $profile = new Profile($user, new \DateTime('now'));
        $user->setProfile($profile);
        $this->assertSame($profile, $user->getProfile());
    }
}
