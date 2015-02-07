<?php
/**
 *
 */

namespace Nowp\User;


class User 
{
    /**
     * @var Profile
     */
    protected $profile;

    function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }

    function getProfile()
    {
        return $this->profile;
    }
}