<?php
/**
 *
 */

namespace Nowp\Tests\User;


use Nowp\Tests\UnitTestCase;
use Nowp\User\User;
use Nowp\User\Profile;

class ProfileTest extends UnitTestCase
{
    public $user, $shortDescription;
    /**
     * @var \DateTime
     */
    public $dateOfBirth;

    function setUp()
    {
        $this->user = new User();
        $this->shortDescription = 'A short description of myself';
        $this->dateOfBirth = \DateTime::createFromFormat('d/m/Y', '10/04/1987');

    }

    function testCanCreateAnProfile()
    {
        new Profile($this->user, $this->dateOfBirth, $this->shortDescription);
    }

    function testCanGetTheAgeFromProfile()
    {
        $profile = new Profile($this->user, $this->dateOfBirth, $this->shortDescription);
        $age = 27;
        $this->assertEquals($age, $profile->getAge());
    }

    function testCanRetrieveProfileData()
    {
        $profile = new Profile($this->user, $this->dateOfBirth, $this->shortDescription);
        $this->assertEquals($this->user, $profile->getUser());
        $this->assertEquals($this->dateOfBirth, $profile->getDateOfBirth());
        $this->assertEquals($this->shortDescription, $profile->getShortDescription());
    }
}
