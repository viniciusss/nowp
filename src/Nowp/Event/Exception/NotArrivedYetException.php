<?php
/**
 *
 */

namespace Nowp\Event\Exception;


use Exception;

class NotArrivedYetException extends \DomainException
{
    public function __construct($message = "Cannot leave an event without arriving there", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}