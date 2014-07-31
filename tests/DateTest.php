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
		$date = new Date('2014-07-15');
		$this->assertTrue($date->isAfter(new Date('2014-07-14')));
	}

	/**
	 * Testing isBefore.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsBeforeAnotherDate()
	{
		$date = new Date('2014-07-15');
		$this->assertTrue($date->isBefore(new Date('2014-07-16')));
	}

	/**
	 * Testing equals.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsEqualToAnotherDate()
	{
		$date = new Date('2014-07-15');
		$this->assertTrue($date->equals(new Date('2014-07-15')));
		$this->assertFalse($date->equals(new Date('2014-07-16')));
	}

	/**
	 * Testing addDays.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddDays
	 */
	public function testCanCreateAnObjectByAddingDaysToIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subDays.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubDays
	 */
	public function testCanCreateAnObjectBySubtractingDaysFromIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addWeeks.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddWeeks
	 */
	public function testCanCreateAnObjectByAddingWeeksToIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subWeeks.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubWeeks
	 */
	public function testCanCreateAnObjectBySubtractingWeeksFromIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addMonths.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddMonths
	 */
	public function testCanCreateAnObjectByAddingMonthsToIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subMonths.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubMonths
	 */
	public function testCanCreateAnObjectBySubtractingMonthsFromIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing addYears.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddYears
	 */
	public function testCanCreateAnObjectByAddingYearsToIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
	}

	/**
	 * Testing subYears.
	 *
	 * @param   Date  $sut       The object to test.
	 * @param   Date  $actual    An actual object.
	 * @param   Date  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubYears
	 */
	public function testCanCreateAnObjectBySubtractingYearsFromIt(Date $sut, Date $actual, Date $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual);
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
	 * Test cases for addDays.
	 *
	 * @return array
	 */
	public function seedForAddDays()
	{
		return Fixture\DataProvider::addDays_Date();
	}

	/**
	 * Test cases for subDays.
	 *
	 * @return array
	 */
	public function seedForSubDays()
	{
		return Fixture\DataProvider::subDays_Date();
	}

	/**
	 * Test cases for addMonths.
	 *
	 * @return array
	 */
	public function seedForAddMonths()
	{
		return Fixture\DataProvider::addMonths_Date();
	}

	/**
	 * Test cases for subMonths.
	 *
	 * @return array
	 */
	public function seedForSubMonths()
	{
		return Fixture\DataProvider::subMonths_Date();
	}

	/**
	 * Test cases for addWeeks.
	 *
	 * @return array
	 */
	public function seedForAddWeeks()
	{
		return Fixture\DataProvider::addWeeks_Date();
	}

	/**
	 * Test cases for subWeeks.
	 *
	 * @return array
	 */
	public function seedForSubWeeks()
	{
		return Fixture\DataProvider::subWeeks_Date();
	}

	/**
	 * Test cases for addYears.
	 *
	 * @return array
	 */
	public function seedForAddYears()
	{
		return Fixture\DataProvider::addYears_Date();
	}

	/**
	 * Test cases for subYears.
	 *
	 * @return array
	 */
	public function seedForSubYears()
	{
		return Fixture\DataProvider::subYears_Date();
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
