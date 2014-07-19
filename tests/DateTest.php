<?php

namespace Joomla\DateTime;

final class DateTest extends \PHPUnit_Framework_TestCase
{
	public function testCanCreateAnObjectRepresentingToday()
	{
		$this->assertEquals(new Date(date('Y-m-d')), Date::today());
	}

	public function testCanCreateAnObjectRepresentingTomorrow()
	{
		$this->assertEquals(new Date(sprintf('%s-%s', date('Y-m'), date('d') + 1)), Date::tomorrow());
	}

	public function testCanCreateAnObjectRepresentingYesterday()
	{
		$this->assertEquals(new Date(sprintf('%s-%s', date('Y-m'), date('d') - 1)), Date::yesterday());
	}

	public function testCanDetermineIfIsAfterAnotherDate()
	{
		$date = new Date('2014-07-15');
		$this->assertTrue($date->isAfter(new Date('2014-07-14')));
	}

	public function testCanDetermineIfIsBeforeAnotherDate()
	{
		$date = new Date('2014-07-15');
		$this->assertTrue($date->isBefore(new Date('2014-07-16')));
	}

	public function testCanDetermineIfIsEqualToAnotherDate()
	{
		$date = new Date('2014-07-15');
		$this->assertTrue($date->equals(new Date('2014-07-15')));
		$this->assertFalse($date->equals(new Date('2014-07-16')));
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

	public function testCanCreateAnObjectForTheBeginOfAWeek()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-14'), $date->startOfWeek());
	}

	public function testCanCreateAnObjectForTheEndOfAWeek()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-20'), $date->endOfWeek());
	}

	public function testCanCreateAnObjectForTheBeginOfAMonth()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-01'), $date->startOfMonth());
	}

	public function testCanCreateAnObjectForTheEndOfAMonth()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-31'), $date->endOfMonth());
	}

	public function testCanCreateAnObjectForTheBeginOfAYear()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-01-01'), $date->startOfYear());
	}

	public function testCanCreateAnObjectForTheEndOfAYear()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-12-31'), $date->endOfYear());
	}

	public function seedForAddDays()
	{
		return Fixture\DataProvider::addDays_Date();
	}

	public function seedForSubDays()
	{
		return Fixture\DataProvider::subDays_Date();
	}

	public function seedForAddMonths()
	{
		return Fixture\DataProvider::addMonths_Date();
	}

	public function seedForSubMonths()
	{
		return Fixture\DataProvider::subMonths_Date();
	}

	public function seedForAddWeeks()
	{
		return Fixture\DataProvider::addWeeks_Date();
	}

	public function seedForSubWeeks()
	{
		return Fixture\DataProvider::subWeeks_Date();
	}

	public function seedForAddYears()
	{
		return Fixture\DataProvider::addYears_Date();
	}

	public function seedForSubYears()
	{
		return Fixture\DataProvider::subYears_Date();
	}

	private function assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
