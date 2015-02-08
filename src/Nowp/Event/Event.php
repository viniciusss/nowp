<?php
/**
 *
 */

namespace Nowp\Event;

use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Nowp\Common\Price;
use Nowp\Common\Hashtag;
use Nowp\Common\Url;
use Nowp\Location\Location;

class Event 
{
    /**
     * Event's name
     * @var string
     */
    protected $name;
    /**
     * Value that should be paid by men and women
     * @var Price
     */
    protected $manPrice, $womanPrice;
    /**
     * When the event starts
     * @var DateTime
     */
    protected $startTime;
    /**
     * Event's description
     * @var string
     */
    protected $description;
    /**
     * @var Hashtag
     */
    protected $hashtag;
    /**
     * Event's location
     * @var Location
     */
    protected $location;
    /**
     * @var Url
     */
    protected $link;

    /**
     * List of Members
     * @var ArrayCollection
     */
    protected $members;

    /**
     * @var null
     */
    protected $maxAttendees = null;

    function __construct()
    {
        $this->members = new ArrayCollection();
    }

    function setName($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException("You must to provide a name for your event");
        }
        $this->name = $name;
    }

    function setManPrice(Price $price)
    {
        $this->manPrice = $price;
    }

    function setWomanPrice(Price $price)
    {
        $this->womanPrice = $price;
    }

    function setStartTime(DateTime $startTime)
    {
        $this->startTime = $startTime;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param Hashtag $hashtag
     */
    public function setHashtag(Hashtag $hashtag)
    {
        $this->hashtag = $hashtag;
    }

    /**
     * @param Location $location
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Price
     */
    public function getManPrice()
    {
        return $this->manPrice;
    }

    /**
     * @return Price
     */
    public function getWomanPrice()
    {
        return $this->womanPrice;
    }

    /**
     * @return DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Hashtag
     */
    public function getHashtag()
    {
        return $this->hashtag;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    function setLink(Url $url = null)
    {
        $this->url = $url;
    }

    function getLink()
    {
        return $this->url;
    }

    function getMembers()
    {
        return $this->members;
    }

    function setMaxAttendees($maxAttendees)
    {
        $this->maxAttendees = $maxAttendees;
    }

    /**
     * @return integer
     */
    public function getMaxAttendees()
    {
        return $this->maxAttendees;
    }
}