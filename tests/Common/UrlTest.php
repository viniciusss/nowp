<?php
/**
 *
 */

namespace Nowp\Tests\Common;


use Nowp\Common\Url;
use Nowp\Tests\UnitTestCase;


class UrlTest extends UnitTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    function testMustThrowAnExceptionWhenGivenInvalidUrl()
    {
        new Url('invalid-url');
    }

    function testToStringMustReturnProvidedUrlAsString()
    {
        $string = 'http://www.foo.com';
        $url = new Url($string);
        $this->assertEquals($string, $url->__toString());
    }
}
