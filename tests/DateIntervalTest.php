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
	public function testCanCreateAnObjectFromDateString($string, DateInterval $expected)
	{
		$this->assertEquals($expected, DateInterval::createFromDateString($string));
	}

	/**
	 * Testing add.
	 *
	 * @param   DateInterval  $sut       DateInterval to test.
	 * @param   DateInterval  $interval  DateInterval to add.
	 * @param   DateInterval  $expected  An expected DateInterval.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAdd
	 */
	public function testCanCreateAnObjectByAddingAnotherIntervalIntoIt(DateInterval $sut, DateInterval $interval, DateInterval $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->add($interval));
	}

	/**
	 * Testing equals.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsEqualToAnotherDateInterval()
	{
		$interval = new DateInterval('P1D');

		$this->assertTrue($interval->equals(new DateInterval('P1D')));
		$this->assertFalse($interval->equals(new DateInterval('PT1H')));
		$this->assertFalse($interval->equals($interval->invert()));
	}

	/**
	 * Testing invert.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectByInvertingTheCurrentOne()
	{
		$sut = new DateInterval("P1D");

		$phpDateInterval = new \DateInterval("P1D");
		$phpDateInterval->invert = true;

		$invert = new DateInterval($phpDateInterval);

		$this->assertEquals($phpDateInterval, $sut->invert()->getDateInterval());
		$this->assertEqualsWithoutChangingSUT($sut, $invert, $sut->invert());

		$this->assertEquals($sut, $sut->invert()->invert());
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
			array('tomorrow',			new DateInterval('P1D')),
		);
	}

	/**
	 * Test cases for add.
	 *
	 * @return array
	 */
	public function seedForAdd()
	{
		$interval = new DateInterval('P1D');
		$invert = $interval->invert();

		return array(
			array(new DateInterval('P1D'), new DateInterval('P1D'), new DateInterval('P2D')),
			array(new DateInterval('P20D'), new DateInterval('P30D'), new DateInterval('P50D')),
			array(new DateInterval('PT100H'), new DateInterval('PT30H'), new DateInterval('PT130H')),
			array(new DateInterval('P10D'), new DateInterval('PT30H'), new DateInterval('P10DT30H')),
			array(new DateInterval('P1Y2M3DT4H5M6S'), new DateInterval('P7Y8M9DT10H11M12S'), new DateInterval('P8Y10M12DT14H16M18S')),
			array(new DateInterval('P10D'), $invert, new DateInterval('P11D')),
		);
	}

	/**
	 * Assertion.
	 *
	 * @param   DateInterval  $sut       The object to test.
	 * @param   DateInterval  $expected  An expected object.
	 * @param   DateInterval  $actual    An actual object.
	 *
	 * @return void
	 */
	private function assertEqualsWithoutChangingSUT(DateInterval $sut, DateInterval $expected, DateInterval $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
