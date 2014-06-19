<?php

/**
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

class DateTimeWrapperTest extends \PHPUnit_Framework_TestCase
{
	const CURRENT = '2014-05-22 12:22:42';

	/** @var DateTimeWrapper */
	private $SUT;

	/**
	 * Set up fixtures
	 *
	 * @return void
	 */
	protected function setUp()
	{
		$this->SUT = new DateTimeWrapper(new DateTime(self::CURRENT));
	}

	/**
	 * Test getters
	 *
	 * @test
	 * @dataProvider seedWithPropertiesAndValues
	 * @return void
	 */
	public function it_should_return_a_value_of_a_property(DateTimeWrapper $datetime, $property, $propertyValue)
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

	public function seedWithPropertiesAndValues()
	{
		$datetime = new DateTimeWrapper(new DateTime("2014-05-25 12:27:39"));
		$leapyear = new DateTimeWrapper(new DateTime("2016-05-02"));

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