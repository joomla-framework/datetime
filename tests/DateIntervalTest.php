<?php
/**
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Tests for DateInterval class.
 *
 * @since  2.0
 */
final class DateIntervalTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Testing createFromDateString.
	 *
	 * @param   string        $string    Date string.
	 * @param   DateInterval  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForCreateFromDateString
	 */
	public function testCanCreateAnObjectViaCreateFromDateStringFactoryMethod($string, DateInterval $expected)
	{
		$this->assertEquals($expected, DateInterval::createFromDateString($string));
	}

	/**
	 * Testing __get.
	 *
	 * @param   DateInterval  $interval       DateInterval to test.
	 * @param   string        $property       A name of a property.
	 * @param   mixed         $propertyValue  An expected value.
	 *
	 * @return void
	 *
	 * @dataProvider seedForGet
	 */
	public function testHasProperties(DateInterval $interval, $property, $propertyValue)
	{
		$this->assertEquals($propertyValue, $interval->$property);
	}

	/**
	 * Test cases for __get.
	 *
	 * @return array
	 */
	public function seedForGet()
	{
		$interval = new DateInterval("P3Y2M8DT4H23M20S");

		return array(
			array($interval, 'y', 3),
			array($interval, 'm', 2),
			array($interval, 'd', 8),
			array($interval, 'h', 4),
			array($interval, 'i', 23),
			array($interval, 's', 20),
			array($interval, 'days', -99999),
			array($interval, 'invert', 0),
		);
	}

	/**
	 * Test cases for createFromDateString.
	 *
	 * @return array
	 */
	public function seedForCreateFromDateString()
	{
		return array(
			array('1 day',				new DateInterval('P1D')),
			array('2 weeks',			new DateInterval('P2W')),
			array('3 months',			new DateInterval('P3M')),
			array('4 years',			new DateInterval('P4Y')),
			array('1 year + 1 day',		new DateInterval('P1Y1D')),
			array('1 day + 12 hours',	new DateInterval('P1DT12H')),
			array('3600 seconds',		new DateInterval('PT3600S')),
		);
	}
}
