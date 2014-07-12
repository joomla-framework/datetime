<?php

/**
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Tests for Date class.
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
		$this->assertTrue($this->SUT->after($this->SUT->subSeconds(1)));
	}

	public function testCanDetermineIfIsBeforeAnotherDatetime()
	{
		$this->assertTrue($this->SUT->before($this->SUT->addSeconds(1)));
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

	/**
	 * @dataProvider seedForTimeSince
	 */
	public function testCanCreateAStringOfATimeDifference($allowAlmost, $detailLevel, DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->timeSince($since, $detailLevel, $allowAlmost));
	}

	public function testCanCreateACopyOfPhpDatetimeObject()
	{
		$this->assertAttributeNotSame($this->SUT->getDateTime(), 'datetime', $this->SUT);
	}




	public function seedForCreateFactoryMethod()
	{
		return Fixture\DateTimeTestProvider::createFactoryMethod();
	}

	public function seedForCreateFromDateFactoryMethod()
	{
		return Fixture\DateTimeTestProvider::createFromDateFactoryMethod();
	}

	public function seedForCreateFromTimeFactoryMethod()
	{
		return Fixture\DateTimeTestProvider::createFromTimeFactoryMethod();
	}

	public function seedForAddDays()
	{
		return Fixture\DateTimeTestProvider::addDays(new DateTime(self::CURRENT));
	}

	public function seedForSubDays()
	{
		return Fixture\DateTimeTestProvider::subDays(new DateTime(self::CURRENT));
	}

	public function seedForAddMonths()
	{
		return Fixture\DateTimeTestProvider::addMonths(new DateTime(self::CURRENT));
	}

	public function seedForSubMonths()
	{
		return Fixture\DateTimeTestProvider::subMonths(new DateTime(self::CURRENT));
	}

	public function seedForAddWeeks()
	{
		return Fixture\DateTimeTestProvider::addWeeks(new DateTime(self::CURRENT));
	}

	public function seedForSubWeeks()
	{
		return Fixture\DateTimeTestProvider::subWeeks(new DateTime(self::CURRENT));
	}

	public function seedForAddYears()
	{
		return Fixture\DateTimeTestProvider::addYears(new DateTime(self::CURRENT));
	}

	public function seedForSubYears()
	{
		return Fixture\DateTimeTestProvider::subYears(new DateTime(self::CURRENT));
	}

	public function seedForAddSeconds()
	{
		return Fixture\DateTimeTestProvider::addSeconds(new DateTime(self::CURRENT));
	}

	public function seedForSubSeconds()
	{
		return Fixture\DateTimeTestProvider::subSeconds(new DateTime(self::CURRENT));
	}

	public function seedForAddMinutes()
	{
		return Fixture\DateTimeTestProvider::addMinutes(new DateTime(self::CURRENT));
	}

	public function seedForSubMinutes()
	{
		return Fixture\DateTimeTestProvider::subMinutes(new DateTime(self::CURRENT));
	}

	public function seedForAddHours()
	{
		return Fixture\DateTimeTestProvider::addHours(new DateTime(self::CURRENT));
	}

	public function seedForSubHours()
	{
		return Fixture\DateTimeTestProvider::subHours(new DateTime(self::CURRENT));
	}

	public function seedForTimeSince()
	{
		return Fixture\DateTimeTestProvider::timeSince();
	}

	private function assertCorrectCalculationWithoutChangingSUT($sut, $expected, $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
