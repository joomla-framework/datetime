<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Tests for Date class.
 *
 * @since  2.0
 */
final class DateTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Testing today.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingToday()
	{
		$this->assertEquals(new Date(date('Y-m-d')), Date::today());
	}

	/**
	 * Testing tomorrow.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingTomorrow()
	{
		$today = Date::today();
		$this->assertEquals($today->addDays(1), Date::tomorrow());
	}

	/**
	 * Testing yesterday.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingYesterday()
	{
		$today = Date::today();
		$this->assertEquals($today->subDays(1), Date::yesterday());
	}

	/**
	 * Testing isAfter.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsAfterAnotherDate()
	{
		$today = Date::today();
		$this->assertTrue($today->isAfter(Date::yesterday()));
	}

	/**
	 * Testing isBefore.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsBeforeAnotherDate()
	{
		$today = Date::today();
		$this->assertTrue($today->isBefore(Date::tomorrow()));
	}

	/**
	 * Testing diff.
	 *
	 * @return void
	 */
	public function testCanReturnADateIntervalObjectAsADifferenceBetweenTwoObjects()
	{
		$today = Date::today();
		$this->assertEquals(new DateInterval('P1D'), $today->diff(Date::tomorrow()));
	}

	/**
	 * Testing equals.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsEqualToAnotherDate()
	{
		$today = Date::today();
		$this->assertTrue($today->equals(Date::today()));
		$this->assertFalse($today->equals(Date::yesterday()));
	}

	/**
	 * Testing addDays.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of days to add.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddDays
	 */
	public function testCanCreateAnObjectByAddingDaysToIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addDays($value));
	}

	/**
	 * Testing subDays.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of days to substract.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubDays
	 */
	public function testCanCreateAnObjectBySubtractingDaysFromIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subDays($value));
	}

	/**
	 * Testing addWeeks.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of weeks to add.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddWeeks
	 */
	public function testCanCreateAnObjectByAddingWeeksToIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addWeeks($value));
	}

	/**
	 * Testing subWeeks.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of weeks to substract.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubWeeks
	 */
	public function testCanCreateAnObjectBySubtractingWeeksFromIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subWeeks($value));
	}

	/**
	 * Testing addMonths.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of months to add.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddMonths
	 */
	public function testCanCreateAnObjectByAddingMonthsToIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addMonths($value));
	}

	/**
	 * Testing subMonths.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of months to substract.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubMonths
	 */
	public function testCanCreateAnObjectBySubtractingMonthsFromIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subMonths($value));
	}

	/**
	 * Testing addYears.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of years to add.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddYears
	 */
	public function testCanCreateAnObjectByAddingYearsToIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addYears($value));
	}

	/**
	 * Testing subYears.
	 *
	 * @param   Date     $sut       The object to test.
	 * @param   integer  $value     Number of years to substract.
	 * @param   Date     $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubYears
	 */
	public function testCanCreateAnObjectBySubtractingYearsFromIt(Date $sut, $value, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subYears($value));
	}

	/**
	 * Testing startOfWeek.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheBeginOfAWeek()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-14'), $date->startOfWeek());
	}

	/**
	 * Testing endOfWeek.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAWeek()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-20'), $date->endOfWeek());
	}

	/**
	 * Testing startOfMonth.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheBeginOfAMonth()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-01'), $date->startOfMonth());
	}

	/**
	 * Testing endOfMonth.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAMonth()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-31'), $date->endOfMonth());
	}

	/**
	 * Testing startOfYear.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheBeginOfAYear()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-01-01'), $date->startOfYear());
	}

	/**
	 * Testing endOfYear.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAYear()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-12-31'), $date->endOfYear());
	}

	/**
	 * Testing since.
	 *
	 * @return void
	 */
	public function testCanCreateAStringOfATimeDifference()
	{
		$date = new Date('2014-08-24');
		$this->assertEquals('2 days ago', $date->since($date->addDays(2)));
	}

	/**
	 * Testing sinceAlmost.
	 *
	 * @return void
	 */
	public function testCanCreateAStringOfAlmostTimeDifference()
	{
		$date = new Date('2014-08-24');
		$this->assertEquals('almost 1 month ago', $date->sinceAlmost($date->addDays(28)));
	}

	/**
	 * Test cases for addDays.
	 *
	 * @return array
	 */
	public function seedForAddDays()
	{
		return Fixture\DataProviderForDate::addDays();
	}

	/**
	 * Test cases for subDays.
	 *
	 * @return array
	 */
	public function seedForSubDays()
	{
		return Fixture\DataProviderForDate::subDays();
	}

	/**
	 * Test cases for addMonths.
	 *
	 * @return array
	 */
	public function seedForAddMonths()
	{
		return Fixture\DataProviderForDate::addMonths();
	}

	/**
	 * Test cases for subMonths.
	 *
	 * @return array
	 */
	public function seedForSubMonths()
	{
		return Fixture\DataProviderForDate::subMonths();
	}

	/**
	 * Test cases for addWeeks.
	 *
	 * @return array
	 */
	public function seedForAddWeeks()
	{
		return Fixture\DataProviderForDate::addWeeks();
	}

	/**
	 * Test cases for subWeeks.
	 *
	 * @return array
	 */
	public function seedForSubWeeks()
	{
		return Fixture\DataProviderForDate::subWeeks();
	}

	/**
	 * Test cases for addYears.
	 *
	 * @return array
	 */
	public function seedForAddYears()
	{
		return Fixture\DataProviderForDate::addYears();
	}

	/**
	 * Test cases for subYears.
	 *
	 * @return array
	 */
	public function seedForSubYears()
	{
		return Fixture\DataProviderForDate::subYears();
	}

	/**
	 * Assertion.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $expected  An expected object.
	 * @param   Date  $actual    An actual object.
	 *
	 * @return void
	 */
	private function assertCorrectCalculationWithoutChangingSUT(Date $sut, Date $expected, Date $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
