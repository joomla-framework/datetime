<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Test;

use Joomla\DateTime\Date;
use Joomla\DateTime\DateInterval;

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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::addDays
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::subDays
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::addWeeks
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::subWeeks
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::addMonths
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::subMonths
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::addYears
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDate::subYears
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
	public function testCanCreateAnObjectForTheStartOfAWeek()
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
	public function testCanCreateAnObjectForTheStartOfAMonth()
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
	public function testCanCreateAnObjectForTheStartOfAYear()
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
