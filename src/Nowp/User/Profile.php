<?php
/**
 *
 */

namespace Nowp\User;


class Profile 
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var \DateTime
     */
    protected $dateOfBirth;
    /**
     * @var string
     */
    protected $shortDescription;

    function __construct(User $user, \DateTime $dateOfBirth, $shortDescription = null)
    {
        $this->user = $user;
        $this->dateOfBirth = $dateOfBirth;
        $this->shortDescription = $shortDescription;
    }

    function getAge()
    {
        return $this->dateOfBirth->diff(new \DateTime('now'))->y;
    }

    function getUser()
    {
        return $this->user;
    }

    function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    function getShortDescription()
    {
        return $this->shortDescription;
    }
}