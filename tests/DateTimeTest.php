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
		$today = DateTime::today();
		$this->assertEquals($today->subDays(1), DateTime::yesterday());
	}

	/**
	 * Testing tomorrow.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectRepresentingTomorrow()
	{
		$today = DateTime::today();
		$this->assertEquals($today->addDays(1), DateTime::tomorrow());
	}

	/**
	 * Testing isAfter.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsAfterAnotherDatetime()
	{
		$today = DateTime::today();
		$this->assertTrue($today->isAfter(DateTime::yesterday()));
	}

	/**
	 * Testing isBefore.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsBeforeAnotherDatetime()
	{
		$today = DateTime::today();
		$this->assertTrue($today->isBefore(DateTime::tomorrow()));
	}

	/**
	 * Testing equals.
	 *
	 * @return void
	 */
	public function testCanDetermineIfIsEqualToAnotherDatetime()
	{
		$today = DateTime::today();
		$this->assertTrue($today->equals(DateTime::today()));
		$this->assertFalse($today->equals(DateTime::now()));
	}

	/**
	 * Testing add.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectByAddingIntervalToIt()
	{
		$today = DateTime::today();
		$tomorrow = $today->add(new DateInterval('P1D'));
		$this->assertCorrectCalculationWithoutChangingSUT($today, DateTime::tomorrow(), $tomorrow);
	}

	/**
	 * Testing sub.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectBySubtractingIntervalFromIt()
	{
		$today = DateTime::today();
		$yesterday = $today->sub(new DateInterval('P1D'));
		$this->assertCorrectCalculationWithoutChangingSUT($today, DateTime::yesterday(), $yesterday);
	}

	/**
	 * Testing addDays.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of days to add.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddDays
	 */
	public function testCanCreateAnObjectByAddingDaysToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addDays($value));
	}

	/**
	 * Testing subDays.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of days to substract.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubDays
	 */
	public function testCanCreateAnObjectBySubtractingDaysFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subDays($value));
	}

	/**
	 * Testing addWeeks.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of weeks to add.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddWeeks
	 */
	public function testCanCreateAnObjectByAddingWeeksToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addWeeks($value));
	}

	/**
	 * Testing subWeeks.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of weeks to substract.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubWeeks
	 */
	public function testCanCreateAnObjectBySubtractingWeeksFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subWeeks($value));
	}

	/**
	 * Testing addMonths.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of months to add.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddMonths
	 */
	public function testCanCreateAnObjectByAddingMonthsToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addMonths($value));
	}

	/**
	 * Testing subMonths.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of months to substract.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubMonths
	 */
	public function testCanCreateAnObjectBySubtractingMonthsFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subMonths($value));
	}

	/**
	 * Testing addYears.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of years to add.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddYears
	 */
	public function testCanCreateAnObjectByAddingYearsToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addYears($value));
	}

	/**
	 * Testing subYears.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of years to substract.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubYears
	 */
	public function testCanCreateAnObjectBySubtractingYearsFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subYears($value));
	}

	/**
	 * Testing addSeconds.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of seconds to add.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddSeconds
	 */
	public function testCanCreateAnObjectByAddingSecondsToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addSeconds($value));
	}

	/**
	 * Testing subSeconds.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of seconds to substract.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubSeconds
	 */
	public function testCanCreateAnObjectBySubtractingSecondsFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subSeconds($value));
	}

	/**
	 * Testing addMinutes.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of minutes to add.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddMinutes
	 */
	public function testCanCreateAnObjectByAddingMinutesToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addMinutes($value));
	}

	/**
	 * Testing subMinutes.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of minutes to substract.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubMinutes
	 */
	public function testCanCreateAnObjectBySubtractingMinutesFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subMinutes($value));
	}

	/**
	 * Testing addHours.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of hours to add.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAddHours
	 */
	public function testCanCreateAnObjectByAddingHoursToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->addHours($value));
	}

	/**
	 * Testing subHours.
	 *
	 * @param   DateTime  $sut       The object to test.
	 * @param   integer   $value     Number of hours to substract.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSubHours
	 */
	public function testCanCreateAnObjectBySubtractingHoursFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertCorrectCalculationWithoutChangingSUT($sut, $expected, $sut->subHours($value));
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
	 * Testing since.
	 *
	 * @param   integer   $detailLevel  A level of details for since method.
	 * @param   DateTime  $since        DateTime to test.
	 * @param   DateTime  $sut          DateTime to test.
	 * @param   string    $string       An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSince
	 */
	public function testCanCreateAStringOfATimeDifference($detailLevel, DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->since($since, $detailLevel));
	}

	/**
	 * Testing sinceAlmost.
	 *
	 * @param   DateTime  $since        DateTime to test.
	 * @param   DateTime  $sut          DateTime to test.
	 * @param   string    $string       An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSinceAlmost
	 */
	public function testCanCreateAStringOfAlmostTimeDifference(DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->sinceAlmost($since));
	}

	/**
	 * Testing getOffset.
	 *
	 * @return void
	 */
	public function testCanReturnAnOffset()
	{
		$date = new DateTime('2014-08-24', new \DateTimeZone('Europe/Warsaw'));
		$this->assertEquals(7200, $date->getOffset());
	}

	/**
	 * Testing getTimestamp.
	 *
	 * @return void
	 */
	public function testCanReturnATimestamp()
	{
		$date = new DateTime('2014-08-24');
		$this->assertEquals(1408831200, $date->getTimestamp());
	}

	/**
	 * Testing getTimeZone.
	 *
	 * @return void
	 */
	public function testCanReturnATimezone()
	{
		$timezone = new \DateTimeZone('Europe/Warsaw');
		$today = DateTime::today($timezone);
		$this->assertEquals($timezone, $today->getTimezone());
	}

	/**
	 * Testing getDateTime.
	 *
	 * @return void
	 */
	public function testCanCreateACopyOfPhpDatetimeObject()
	{
		$today = DateTime::today();
		$datetime = $today->getDateTime();
		$this->assertInstanceOf('\DateTime', $datetime);
		$this->assertAttributeNotSame($datetime, 'datetime', $today);
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
		$this->assertEquals($propertyValue, $datetime->get($property));
	}

	/**
	 * Testing __get.
	 *
	 * @return void
	 */
	public function testWillTriggerAnErrorIfAPropertyDoesNotExist()
	{
		$this->setExpectedException('PHPUnit_Framework_Error_Notice');
		$today = DateTime::today();
		$today->iDoNotExist;
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
	 * Testing a default parser.
	 *
	 * @return void
	 */
	public function testThereIsNoDefaultParserMethod()
	{
		$this->setExpectedException('\BadMethodCallException');
		DateTime::parse('test', 'test');
	}

	/**
	 * Testing a custom parser.
	 *
	 * @param   string    $name      A name of a parser.
	 * @param   mixed     $value     A value to parse.
	 * @param   DateTime  $expected  An expected DateTime object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForDummyParser
	 */
	public function testCanBeEasilyExtendedByCustomParsers($name, $value, DateTime $expected)
	{
		DateTime::setParser(new Fixture\DummyParser);
		$this->assertEquals($expected, DateTime::parse($name, $value));
	}

	/**
	 * Test cases for create.
	 *
	 * @return array
	 */
	public function seedForCreateFactoryMethod()
	{
		return Fixture\DataProviderForDateTime::createFactoryMethod();
	}

	/**
	 * Test cases for createFromDate.
	 *
	 * @return array
	 */
	public function seedForCreateFromDateFactoryMethod()
	{
		return Fixture\DataProviderForDateTime::createFromDateFactoryMethod();
	}

	/**
	 * Test cases for createFromTime.
	 *
	 * @return array
	 */
	public function seedForCreateFromTimeFactoryMethod()
	{
		return Fixture\DataProviderForDateTime::createFromTimeFactoryMethod();
	}

	/**
	 * Test cases for addDays.
	 *
	 * @return array
	 */
	public function seedForAddDays()
	{
		return Fixture\DataProviderForDateTime::addDays();
	}

	/**
	 * Test cases for subDays.
	 *
	 * @return array
	 */
	public function seedForSubDays()
	{
		return Fixture\DataProviderForDateTime::subDays();
	}

	/**
	 * Test cases for addMonths.
	 *
	 * @return array
	 */
	public function seedForAddMonths()
	{
		return Fixture\DataProviderForDateTime::addMonths();
	}

	/**
	 * Test cases for subMonths.
	 *
	 * @return array
	 */
	public function seedForSubMonths()
	{
		return Fixture\DataProviderForDateTime::subMonths();
	}

	/**
	 * Test cases for addWeeks.
	 *
	 * @return array
	 */
	public function seedForAddWeeks()
	{
		return Fixture\DataProviderForDateTime::addWeeks();
	}

	/**
	 * Test cases for subWeeks.
	 *
	 * @return array
	 */
	public function seedForSubWeeks()
	{
		return Fixture\DataProviderForDateTime::subWeeks();
	}

	/**
	 * Test cases for addYears.
	 *
	 * @return array
	 */
	public function seedForAddYears()
	{
		return Fixture\DataProviderForDateTime::addYears();
	}

	/**
	 * Test cases for subYears.
	 *
	 * @return array
	 */
	public function seedForSubYears()
	{
		return Fixture\DataProviderForDateTime::subYears();
	}

	/**
	 * Test cases for addSeconds.
	 *
	 * @return array
	 */
	public function seedForAddSeconds()
	{
		return Fixture\DataProviderForDateTime::addSeconds();
	}

	/**
	 * Test cases for subSeconds.
	 *
	 * @return array
	 */
	public function seedForSubSeconds()
	{
		return Fixture\DataProviderForDateTime::subSeconds();
	}

	/**
	 * Test cases for addMinutes.
	 *
	 * @return array
	 */
	public function seedForAddMinutes()
	{
		return Fixture\DataProviderForDateTime::addMinutes();
	}

	/**
	 * Test cases for subMinutes.
	 *
	 * @return array
	 */
	public function seedForSubMinutes()
	{
		return Fixture\DataProviderForDateTime::subMinutes();
	}

	/**
	 * Test cases for addHours.
	 *
	 * @return array
	 */
	public function seedForAddHours()
	{
		return Fixture\DataProviderForDateTime::addHours();
	}

	/**
	 * Test cases for subHours.
	 *
	 * @return array
	 */
	public function seedForSubHours()
	{
		return Fixture\DataProviderForDateTime::subHours();
	}

	/**
	 * Test cases for since.
	 *
	 * @return array
	 */
	public function seedForSince()
	{
		return Fixture\DataProviderForDateTime::since();
	}

	/**
	 * Test cases for sinceAlmost.
	 *
	 * @return array
	 */
	public function seedForSinceAlmost()
	{
		return Fixture\DataProviderForDateTime::sinceAlmost();
	}

	/**
	 * Test cases for __get.
	 *
	 * @return array
	 */
	public function seedForGet()
	{
		return Fixture\DataProviderForDateTime::DateTimeGetter();
	}

	/**
	 * Test cases for __get.
	 *
	 * @return array
	 */
	public function seedForDummyGetter()
	{
		return Fixture\DataProviderForDateTime::DummyGetter();
	}

	/**
	 * Test cases for parse.
	 *
	 * @return array
	 */
	public function seedForDummyParser()
	{
		return Fixture\DataProviderForDateTime::DummyParser();
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
