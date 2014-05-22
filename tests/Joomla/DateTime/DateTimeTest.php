<?php

namespace Joomla\DateTime;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    /** @var DateTime*/
    private $SUT;

    protected function setUp()
    {
        $this->SUT = new DateTime("2014-05-22");
    }

    /** @test */
    public function it_should_return_a_new_object_with_one_day_added()
    {
        $newDate = $this->SUT->add(new \DateInterval("P1D"));

        $this->assertEquals("2014-05-22", $this->SUT->format("Y-m-d"));
        $this->assertEquals("2014-05-23", $newDate->format("Y-m-d"));
    }

}