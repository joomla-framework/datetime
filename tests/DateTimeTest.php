<?php

/**
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Tests for Date class.
 *
 * @since  2.0
 */
class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    const FORMAT = 'Y-m-d H:i:s';
    const CURRENT = '2014-05-22 12:22:42';
    const ADDED_1_DAY = '2014-05-23 12:22:42';
    const SUBED_1_DAY = '2014-05-21 12:22:42';

    /** @var DateTime */
    private $SUT;

    /**
     * Set up fixtures
     *
     * @return void
     */
    protected function setUp()
    {
        $this->SUT = new DateTime(self::CURRENT);
    }


    /** @test */
    public function it_should_return_a_new_instance_with_added_interval()
    {
        $current = clone $this->SUT;
        $added = $this->SUT->add(new \DateInterval('P1D'));

        $this->assertNotEquals($added, $this->SUT);
        $this->assertEquals($current, $this->SUT);
        $this->assertEquals($added->format(self::FORMAT), self::ADDED_1_DAY);
    }

    /** @test */
    public function it_should_return_a_new_instance_with_subed_interval()
    {
        $current = clone $this->SUT;
        $subed = $this->SUT->sub(new \DateInterval('P1D'));

        $this->assertNotEquals($subed, $this->SUT);
        $this->assertEquals($current, $this->SUT);
        $this->assertEquals($subed->format(self::FORMAT), self::SUBED_1_DAY);
    }

    /**
     * @test
     * @dataProvider seedWithDateTimesForCalculations
     */
    public function it_should_return_a_new_instance_of_an_object($sut, $actual, $expected)
    {
        $this->assertEquals($expected, $actual);
        $this->assertNotEquals($actual, $sut);
    }

    /** @test */
    public function it_should_return_a_new_instance_of_php_datetime_object()
    {
        $this->assertEquals(-1, intval('-1'));

        $this->assertAttributeNotSame($this->SUT->toDateTime(), 'datetime', $this->SUT);
    }

    /**
     * Test getters
     *
     * @test
     * @dataProvider seedWithPropertiesAndValues
     * @return void
     */
    public function it_should_return_a_value_of_a_property(DateTime $datetime, $property, $propertyValue)
    {
        $this->assertEquals($propertyValue, $datetime->$property);
    }

    /** @test */
    public function it_should_return_a_date_in_iso8601_format()
    {
        $this->assertEquals('2014-05-22T12:22:42+02:00', $this->SUT->toISO8601());
    }

    /** @test */
    public function it_should_return_a_date_in_rfc822_format()
    {
        $this->assertEquals('Thu, 22 May 2014 12:22:42 +0200', $this->SUT->toRFC822());
    }

    public function seedWithDateTimesForCalculations()
    {
        $sut = new DateTime(self::CURRENT);

        return array(
            array($sut, $sut->addDays(1), $sut->add(new \DateInterval('P1D'))),
            array($sut, $sut->addDays(-1), $sut->sub(new \DateInterval('P1D'))),
            array($sut, $sut->addMonths(1), $sut->add(new \DateInterval('P1M'))),
            array($sut, $sut->addMonths(-1), $sut->sub(new \DateInterval('P1M'))),
            array($sut, $sut->addYears(1), $sut->add(new \DateInterval('P1Y'))),
            array($sut, $sut->addYears(-1), $sut->sub(new \DateInterval('P1Y'))),
            array($sut, $sut->addSeconds(1), $sut->add(new \DateInterval('PT1S'))),
            array($sut, $sut->addSeconds(-1), $sut->sub(new \DateInterval('PT1S'))),
            array($sut, $sut->addMinutes(1), $sut->add(new \DateInterval('PT1M'))),
            array($sut, $sut->addMinutes(-1), $sut->sub(new \DateInterval('PT1M'))),
            array($sut, $sut->addHours(1), $sut->add(new \DateInterval('PT1H'))),
            array($sut, $sut->addHours(-1), $sut->sub(new \DateInterval('PT1H'))),

        );
    }

    public function seedWithPropertiesAndValues()
    {
        $datetime = new DateTime("2014-05-25 12:27:39");
        $leapyear = new DateTime("2016-05-02");

        return array(
            array($datetime, 'daysinmonth', 31),
            array($datetime, 'dayofweek', 7),
            array($datetime, 'dayofyear', 144),
            array($datetime, 'isleapyear', false),
            array($leapyear, 'isleapyear', true),
            array($datetime, 'day', 25),
            array($datetime, 'hour', 12),
            array($datetime, 'minute', 27),
            array($datetime, 'second', 39),
            array($datetime, 'month', 5),
            array($datetime, 'ordinal', 'th'),
            array($leapyear, 'ordinal', 'nd'),
            array($datetime, 'week', 21),
            array($datetime, 'year', 2014),
        );
    }

}
