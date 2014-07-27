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

	/**
	 * Setting all up.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		$this->SUT = new DateTime(self::CURRENT);
	}

	/**
	 * Testing create.
	 *
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForCreateFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFactoryMethod(DateTime $actual, DateTime $expected)
	{
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Testing createFromDate.
	 *
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForCreateFromDateFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFromDateFactoryMethod(DateTime $actual, DateTime $expected)
	{
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Testing createFromTime.
	 *
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForCreateFromTimeFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFromTimeFactoryMethod(DateTime $actual, DateTime $expected)
	{
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Testing today.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingToday()
	{
		$this->assertEquals(new DateTime(date('Y-m-d 00:00:00')), DateTime::today());
	}

	/**
	 * Testing now.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingNow()
	{
		$this->assertEquals(new DateTime(date('Y-m-d H:i:s')), DateTime::now());
	}

	/**
	 * Testing yesterday.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingYesterday()
	{
		$this->assertEquals(new DateTime(sprintf('%s-%s 00:00:00', date('Y-m'), date('d') - 1)), DateTime::yesterday());
	}

	/**
	 * Testing tomorrow.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingTomorrow()
	{
		$this->assertEquals(new DateTime(sprintf('%s-%s 00:00:00', date('Y-m'), date('d') + 1)), DateTime::tomorrow());
	}

	/**
	 * Testing isAfter.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsAfterAnotherDatetime()
	{
		$this->assertTrue($this->SUT->isAfter($this->SUT->subSeconds(1)));
	}

	/**
	 * Testing isBefore.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsBeforeAnotherDatetime()
	{
		$this->assertTrue($this->SUT->isBefore($this->SUT->addSeconds(1)));
	}

	/**
	 * Testing equals.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsEqualToAnotherDatetime()
	{
		$this->assertTrue($this->SUT->equals(new DateTime(self::CURRENT)));
		$this->assertFalse($this->SUT->equals($this->SUT->addSeconds(1)));
	}

	/**
	 * Testing add.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectByAddingIntervalToIt()
	{
		$current = clone $this->SUT;
		$added = $this->SUT->add(new \DateInterval('P1D'));

		$this->assertNotEquals($added, $this->SUT);
		$this->assertEquals($current, $this->SUT);
		$this->assertEquals($added->format(self::FORMAT), self::ADDED_1_DAY);
	}

	/**
	 * Testing sub.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectBySubtractingIntervalFromIt()
	{
		$current = clone $this->SUT;
		$subed = $this->SUT->sub(new \DateInterval('P1D'));

		$this->assertNotEquals($subed, $this->SUT);
		$this->assertEquals($current, $this->SUT);
		$this->assertEquals($subed->format(self::FORMAT), self::SUBED_1_DAY);
	}

	/**
	 * Testing addDays.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddDays
	 */
	public function testCanCreateAnObjectByAddingDaysToIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subDays.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubDays
	 */
	public function testCanCreateAnObjectBySubtractingDaysFromIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addWeeks.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddWeeks
	 */
	public function testCanCreateAnObjectByAddingWeeksToIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subWeeks.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubWeeks
	 */
	public function testCanCreateAnObjectBySubtractingWeeksFromIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addMonths.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddMonths
	 */
	public function testCanCreateAnObjectByAddingMonthsToIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subMonths.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubMonths
	 */
	public function testCanCreateAnObjectBySubtractingMonthsFromIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addYears.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddYears
	 */
	public function testCanCreateAnObjectByAddingYearsToIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subYears.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubYears
	 */
	public function testCanCreateAnObjectBySubtractingYearsFromIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addSeconds.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddSeconds
	 */
	public function testCanCreateAnObjectByAddingSecondsToIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subSeconds.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubSeconds
	 */
	public function testCanCreateAnObjectBySubtractingSecondsFromIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addMinutes.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddMinutes
	 */
	public function testCanCreateAnObjectByAddingMinutesToIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subMinutes.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubMinutes
	 */
	public function testCanCreateAnObjectBySubtractingMinutesFromIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addHours.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddHours
	 */
	public function testCanCreateAnObjectByAddingHoursToIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subHours.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $actual    An actual object.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubHours
	 */
	public function testCanCreateAnObjectBySubtractingHoursFromIt(DateTime $sut, DateTime $actual, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testin startOfDay.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheBeginOfADay()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-15 00:00:00'), $date->startOfDay());
	}

	/**
	 * Testing endOfDay.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfADay()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-15 23:59:59'), $date->endOfDay());
	}

	/**
	 * Testing startOfWeek.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheBeginOfAWeek()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-14 00:00:00'), $date->startOfWeek());
	}

	/**
	 * Testing endOfWeek.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAWeek()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-20 23:59:59'), $date->endOfWeek());
	}

	/**
	 * Testing startOfMonth.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheBeginOfAMonth()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-01 00:00:00'), $date->startOfMonth());
	}

	/**
	 * Testing endOfMonth.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAMonth()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-07-31 23:59:59'), $date->endOfMonth());
	}

	/**
	 * Testing startOfYear.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheBeginOfAYear()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-01-01 00:00:00'), $date->startOfYear());
	}

	/**
	 * Testing endOfYear.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAYear()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new DateTime('2014-12-31 23:59:59'), $date->endOfYear());
	}

	/**
	 * Testing timeSince.
	 *
	 * @param   integer   $detailLevel  A level of details for timeSince method.
	 * @param   DateTime  $since        DateTime to test.
	 * @param   DateTime  $sut          DateTime to test.
	 * @param   string    $string       An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForTimeSince
	 */
	public function testCanCreateAStringOfATimeDifference($detailLevel, DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->timeSince($since, $detailLevel));
	}

	/**
	 * Testing almostTimeSince.
	 *
	 * @param   DateTime  $since   DateTime to test.
	 * @param   DateTime  $sut     DateTime to test.
	 * @param   string    $string  An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAlmostTimeSince
	 */
	public function testCanCreateAStringOfAlmostTimeDifference(DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->almostTimeSince($since));
	}

	/**
	 * Testing getDateTime.
	 *
	 * @return void
	 */
	public function testCanCreateACopyOfPhpDatetimeObject()
	{
		$this->assertAttributeNotSame($this->SUT->getDateTime(), 'datetime', $this->SUT);
	}

	/**
	 * Testing __get.
	 *
	 * @param   DateTime  $datetime       DateTime to test.
	 * @param   string    $property       A name of a property.
	 * @param   string    $propertyValue  An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForGet
	 */
	public function testHasProperties(DateTime $datetime, $property, $propertyValue)
	{
		$this->assertEquals($propertyValue, $datetime->$property);
	}

	/**
	 * Testing a custom getter.
	 *
	 * @param   DateTime  $datetime       DateTime to test.
	 * @param   string    $property       A name of a property.
	 * @param   string    $propertyValue  An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForDummyGetter
	 */
	public function testCanBeEasilyExtendedByCustomProperties(DateTime $datetime, $property, $propertyValue)
	{
		DateTime::setGetter(new Fixture\DummyGetter(new Getter\DateTimeGetter));
		$this->assertEquals($propertyValue, $datetime->$property);
	}

	/**
	 * Test cases for create.
	 *
	 * @return array
	 */
	public function seedForCreateFactoryMethod()
	{
		return Fixture\DataProvider::createFactoryMethod();
	}

	/**
	 * Test cases for createFromDate.
	 *
	 * @return array
	 */
	public function seedForCreateFromDateFactoryMethod()
	{
		return Fixture\DataProvider::createFromDateFactoryMethod();
	}

	/**
	 * Test cases for createFromTime.
	 *
	 * @return array
	 */
	public function seedForCreateFromTimeFactoryMethod()
	{
		return Fixture\DataProvider::createFromTimeFactoryMethod();
	}

	/**
	 * Test cases for addDays.
	 *
	 * @return array
	 */
	public function seedForAddDays()
	{
		return Fixture\DataProvider::addDays();
	}

	/**
	 * Test cases for subDays.
	 *
	 * @return array
	 */
	public function seedForSubDays()
	{
		return Fixture\DataProvider::subDays();
	}

	/**
	 * Test cases for addMonths.
	 *
	 * @return array
	 */
	public function seedForAddMonths()
	{
		return Fixture\DataProvider::addMonths();
	}

	/**
	 * Test cases for subMonths.
	 *
	 * @return array
	 */
	public function seedForSubMonths()
	{
		return Fixture\DataProvider::subMonths();
	}

	/**
	 * Test cases for addWeeks.
	 *
	 * @return array
	 */
	public function seedForAddWeeks()
	{
		return Fixture\DataProvider::addWeeks();
	}

	/**
	 * Test cases for subWeeks.
	 *
	 * @return array
	 */
	public function seedForSubWeeks()
	{
		return Fixture\DataProvider::subWeeks();
	}

	/**
	 * Test cases for addYears.
	 *
	 * @return array
	 */
	public function seedForAddYears()
	{
		return Fixture\DataProvider::addYears();
	}

	/**
	 * Test cases for subYears.
	 *
	 * @return array
	 */
	public function seedForSubYears()
	{
		return Fixture\DataProvider::subYears();
	}

	/**
	 * Test cases for addSeconds.
	 *
	 * @return array
	 */
	public function seedForAddSeconds()
	{
		return Fixture\DataProvider::addSeconds();
	}

	/**
	 * Test cases for subSeconds.
	 *
	 * @return array
	 */
	public function seedForSubSeconds()
	{
		return Fixture\DataProvider::subSeconds();
	}

	/**
	 * Test cases for addMinutes.
	 *
	 * @return array
	 */
	public function seedForAddMinutes()
	{
		return Fixture\DataProvider::addMinutes();
	}

	/**
	 * Test cases for subMinutes.
	 *
	 * @return array
	 */
	public function seedForSubMinutes()
	{
		return Fixture\DataProvider::subMinutes();
	}

	/**
	 * Test cases for addHours.
	 *
	 * @return array
	 */
	public function seedForAddHours()
	{
		return Fixture\DataProvider::addHours();
	}

	/**
	 * Test cases for subHours.
	 *
	 * @return array
	 */
	public function seedForSubHours()
	{
		return Fixture\DataProvider::subHours();
	}

	/**
	 * Test cases for timeSince.
	 *
	 * @return array
	 */
	public function seedForTimeSince()
	{
		return Fixture\DataProvider::timeSince();
	}

	/**
	 * Test cases for almostTimeSince.
	 *
	 * @return array
	 */
	public function seedForAlmostTimeSince()
	{
		return Fixture\DataProvider::almostTimeSince();
	}

	/**
	 * Test cases for __get.
	 *
	 * @return array
	 */
	public function seedForGet()
	{
		return Fixture\DataProvider::DateTimeGetter();
	}

	/**
	 * Test cases for __get.
	 *
	 * @return array
	 */
	public function seedForDummyGetter()
	{
		return Fixture\DataProvider::DummyGetter();
	}

	/**
	 * Assertion.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   DateTime  $expected  An expected object.
	 * @param   DateTime  $actual    An actual object.
	 *
	 * @return void
	 */
	private function assertCorrectCalculationWithoutChangingSUT(DateTime $sut, DateTime $expected, DateTime $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
