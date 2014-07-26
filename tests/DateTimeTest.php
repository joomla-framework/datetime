<?php
/**
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Tests for DateTime class.
 *
 * @since  2.0
 */
final class DateTimeTest extends \PHPUnit_Framework_TestCase
{
	const FORMAT = 'Y-m-d H:i:s';
	const CURRENT = '2014-05-22 12:22:42';
	const ADDED_1_DAY = '2014-05-23 12:22:42';
	const SUBED_1_DAY = '2014-05-21 12:22:42';

	/** @var DateTime */
	private $SUT;

	protected function setUp()
	{
		$this->SUT = new DateTime(self::CURRENT);
	}

	/**
	 * @dataProvider seedForCreateFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFactoryMethod(DateTime $sut, DateTime $expected)
	{
		$this->assertEquals($expected, $sut);
	}

	/**
	 * @dataProvider seedForCreateFromDateFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFromDateFactoryMethod(DateTime $sut, DateTime $expected)
	{
		$this->assertEquals($expected, $sut);
	}

	/**
	 * @dataProvider seedForCreateFromTimeFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFromTimeFactoryMethod(DateTime $sut, DateTime $expected)
	{
		$this->assertEquals($expected, $sut);
	}

	public function testCanCreateAnObjectRepresentingToday()
	{
		$this->assertEquals(new DateTime(date('Y-m-d 00:00:00')), DateTime::today());
	}

	public function testCanCreateAnObjectRepresentingNow()
	{
		$this->assertEquals(new DateTime(date('Y-m-d H:i:s')), DateTime::now());
	}

	public function testCanCreateAnObjectRepresentingYesterday()
	{
		$this->assertEquals(new DateTime(sprintf('%s-%s 00:00:00', date('Y-m'), date('d') - 1)), DateTime::yesterday());
	}

	public function testCanCreateAnObjectRepresentingTomorrow()
	{
		$this->assertEquals(new DateTime(sprintf('%s-%s 00:00:00', date('Y-m'), date('d') + 1)), DateTime::tomorrow());
	}

	public function testCanDetermineIfIsAfterAnotherDatetime()
	{
		$this->assertTrue($this->SUT->isAfter($this->SUT->subSeconds(1)));
	}

	public function testCanDetermineIfIsBeforeAnotherDatetime()
	{
		$this->assertTrue($this->SUT->isBefore($this->SUT->addSeconds(1)));
	}

	public function testCanDetermineIfIsEqualToAnotherDatetime()
	{
		$this->assertTrue($this->SUT->equals(new DateTime(self::CURRENT)));
		$this->assertFalse($this->SUT->equals($this->SUT->addSeconds(1)));
	}

	public function testCanCreateAnObjectByAddingIntervalToIt()
	{
		$current = clone $this->SUT;
		$added = $this->SUT->add(new \DateInterval('P1D'));

		$this->assertNotEquals($added, $this->SUT);
		$this->assertEquals($current, $this->SUT);
		$this->assertEquals($added->format(self::FORMAT), self::ADDED_1_DAY);
	}

	public function testCanCreateAnObjectBySubtractingIntervalFromIt()
	{
		$current = clone $this->SUT;
		$subed = $this->SUT->sub(new \DateInterval('P1D'));

		$this->assertNotEquals($subed, $this->SUT);
		$this->assertEquals($current, $this->SUT);
		$this->assertEquals($subed->format(self::FORMAT), self::SUBED_1_DAY);
	}

	/**
	 * @dataProvider seedForAddDays
	 */
	public function testCanCreateAnObjectByAddingDaysToIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForSubDays
	 */
	public function testCanCreateAnObjectBySubtractingDaysFromIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForAddWeeks
	 */
	public function testCanCreateAnObjectByAddingWeeksToIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForSubWeeks
	 */
	public function testCanCreateAnObjectBySubtractingWeeksFromIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForAddMonths
	 */
	public function testCanCreateAnObjectByAddingMonthsToIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForSubMonths
	 */
	public function testCanCreateAnObjectBySubtractingMonthsFromIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForAddYears
	 */
	public function testCanCreateAnObjectByAddingYearsToIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForSubYears
	 */
	public function testCanCreateAnObjectBySubtractingYearsFromIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForAddSeconds
	 */
	public function testCanCreateAnObjectByAddingSecondsToIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForSubSeconds
	 */
	public function testCanCreateAnObjectBySubtractingSecondsFromIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForAddMinutes
	 */
	public function testCanCreateAnObjectByAddingMinutesToIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForSubMinutes
	 */
	public function testCanCreateAnObjectBySubtractingMinutesFromIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForAddHours
	 */
	public function testCanCreateAnObjectByAddingHoursToIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * @dataProvider seedForSubHours
	 */
	public function testCanCreateAnObjectBySubtractingHoursFromIt($sut, $actual, $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	public function testCanCreateAnObjectForTheBeginOfADay()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-15 00:00:00'), $date->startOfDay());
	}

	public function testCanCreateAnObjectForTheEndOfADay()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-15 23:59:59'), $date->endOfDay());
	}

	public function testCanCreateAnObjectForTheBeginOfAWeek()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-14 00:00:00'), $date->startOfWeek());
	}

	public function testCanCreateAnObjectForTheEndOfAWeek()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-20 23:59:59'), $date->endOfWeek());
	}

	public function testCanCreateAnObjectForTheBeginOfAMonth()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-01 00:00:00'), $date->startOfMonth());
	}

	public function testCanCreateAnObjectForTheEndOfAMonth()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-31 23:59:59'), $date->endOfMonth());
	}

	public function testCanCreateAnObjectForTheBeginOfAYear()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-01-01 00:00:00'), $date->startOfYear());
	}

	public function testCanCreateAnObjectForTheEndOfAYear()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-12-31 23:59:59'), $date->endOfYear());
	}

	/**
	 * @dataProvider seedForTimeSince
	 */
	public function testCanCreateAStringOfATimeDifference($detailLevel, DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->timeSince($since, $detailLevel));
	}

	/**
	 * @dataProvider seedForAlmostTimeSince
	 */
	public function testCanCreateAStringOfAlmostTimeDifference(DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->almostTimeSince($since));
	}

	public function testCanCreateACopyOfPhpDatetimeObject()
	{
		$this->assertAttributeNotSame($this->SUT->getDateTime(), 'datetime', $this->SUT);
	}

	/**
	 * @dataProvider seedWithPropertiesAndValues
	 */
	public function testHasProperties(DateTime $datetime, $property, $propertyValue)
	{
		$this->assertEquals($propertyValue, $datetime->$property);
	}

	/**
	 * @dataProvider seedForDummyGetter
	 */
	public function testCanBeEasilyExtendedByCustomProperties(DateTime $datetime, $property, $propertyValue)
	{
		DateTime::setGetter(new Fixture\DummyGetter(new Getter\DateTimeGetter()));
		$this->assertEquals($propertyValue, $datetime->$property);
	}

	public function seedForCreateFactoryMethod()
	{
		return Fixture\DataProvider::createFactoryMethod();
	}

	public function seedForCreateFromDateFactoryMethod()
	{
		return Fixture\DataProvider::createFromDateFactoryMethod();
	}

	public function seedForCreateFromTimeFactoryMethod()
	{
		return Fixture\DataProvider::createFromTimeFactoryMethod();
	}

	public function seedForAddDays()
	{
		return Fixture\DataProvider::addDays();
	}

	public function seedForSubDays()
	{
		return Fixture\DataProvider::subDays();
	}

	public function seedForAddMonths()
	{
		return Fixture\DataProvider::addMonths();
	}

	public function seedForSubMonths()
	{
		return Fixture\DataProvider::subMonths();
	}

	public function seedForAddWeeks()
	{
		return Fixture\DataProvider::addWeeks();
	}

	public function seedForSubWeeks()
	{
		return Fixture\DataProvider::subWeeks();
	}

	public function seedForAddYears()
	{
		return Fixture\DataProvider::addYears();
	}

	public function seedForSubYears()
	{
		return Fixture\DataProvider::subYears();
	}

	public function seedForAddSeconds()
	{
		return Fixture\DataProvider::addSeconds();
	}

	public function seedForSubSeconds()
	{
		return Fixture\DataProvider::subSeconds();
	}

	public function seedForAddMinutes()
	{
		return Fixture\DataProvider::addMinutes();
	}

	public function seedForSubMinutes()
	{
		return Fixture\DataProvider::subMinutes();
	}

	public function seedForAddHours()
	{
		return Fixture\DataProvider::addHours();
	}

	public function seedForSubHours()
	{
		return Fixture\DataProvider::subHours();
	}

	public function seedForTimeSince()
	{
		return Fixture\DataProvider::timeSince();
	}

	public function seedForAlmostTimeSince()
	{
		return Fixture\DataProvider::almostTimeSince();
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

	public function seedForDummyGetter()
	{
		$datetime = new DateTime("2014-05-25 12:27:39");

		return array_merge($this->seedWithPropertiesAndValues(), array(
			array($datetime, 'test', 'It works!')
		));
	}

	private function assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
