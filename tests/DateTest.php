<?php

namespace Joomla\DateTime;

final class DateTest extends \PHPUnit_Framework_TestCase
{
	public function testCanCreateAnObjectFromJoomlaDateTimeObject()
	{
		$datetime = DateTime::now();
		$this->assertEquals(new Date(date('Y-m-d')), new Date($datetime));
	}

	public function testCanCreateAnObjectFromFormat()
	{
		$this->assertEquals(new Date(date('Y-m-d')), Date::createFromFormat('Y-m-d', date('Y-m-d')));
	}

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

	public function testCanDetermineIfIsAfterAnotherDatetime()
	{
		$date = new Date('2014-07-15');
		$this->assertTrue($date->after(new Date('2014-07-14')));
	}

	public function testCanDetermineIfIsBeforeAnotherDatetime()
	{
		$date = new Date('2014-07-15');
		$this->assertTrue($date->before(new Date('2014-07-16')));
	}

	public function testCanDetermineIfIsEqualToAnotherDatetime()
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
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-14'), $date->beginOfWeek());
	}

	public function testCanCreateAnObjectForTheEndOfAWeek()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-20'), $date->endOfWeek());
	}

	public function testCanCreateAnObjectForTheBeginOfAMonth()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-01'), $date->beginOfMonth());
	}

	public function testCanCreateAnObjectForTheEndOfAMonth()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-07-31'), $date->endOfMonth());
	}

	public function testCanCreateAnObjectForTheBeginOfAYear()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-01-01'), $date->beginOfYear());
	}

	public function testCanCreateAnObjectForTheEndOfAYear()
	{
		$date = new Date('2014-07-15');
		$this->assertCorrectCalculationWithoutChangingSUT($date, new Date('2014-12-31'), $date->endOfYear());
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

	private function assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
