<?php
/**
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Test;

use Joomla\DateTime\DateInterval;
use Joomla\DateTime\DateTime;
use Joomla\DateTime\Getter\DateTimeGetter;

/**
 * Tests for DateTime class.
 *
 * @since  2.0
 */
final class DateTimeTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Sets english language for every test.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		DateTime::setLocale('en');
	}

	/**
	 * Testing create.
	 *
	 * @param   integer   $year      The year.
	 * @param   integer   $month     The month.
	 * @param   integer   $day       The day of the month.
	 * @param   integer   $hour      The hour.
	 * @param   integer   $minute    The minute.
	 * @param   integer   $second    The second.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::createFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFactoryMethod($year, $month, $day, $hour, $minute, $second, DateTime $expected)
	{
		$this->assertEquals($expected, DateTime::create($year, $month, $day, $hour, $minute, $second));
	}

	/**
	 * Testing createFromDate.
	 *
	 * @param   integer   $year      The year.
	 * @param   integer   $month     The month.
	 * @param   integer   $day       The day of the month.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::createFromDateFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFromDateFactoryMethod($year, $month, $day, DateTime $expected)
	{
		$this->assertEquals($expected, DateTime::createFromDate($year, $month, $day));
	}

	/**
	 * Testing createFromTime.
	 *
	 * @param   integer   $hour      The hour.
	 * @param   integer   $minute    The minute.
	 * @param   integer   $second    The second.
	 * @param   DateTime  $expected  An expected object.
	 *
	 * @return void
	 *
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::createFromTimeFactoryMethod
	 */
	public function testCanCreateAnObjectViaCreateFromTimeFactoryMethod($hour, $minute, $second, DateTime $expected)
	{
		$this->assertEquals($expected, DateTime::createFromTime($hour, $minute, $second));
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
		$expected = DateTime::tomorrow();
		$this->assertEqualsWithoutChangingSUT($today, $expected, $today->add(new DateInterval('P1D')));
	}

	/**
	 * Testing sub.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectBySubtractingIntervalFromIt()
	{
		$today = DateTime::today();
		$expected = DateTime::yesterday();
		$this->assertEqualsWithoutChangingSUT($today, $expected, $today->sub(new DateInterval('P1D')));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::addDays
	 */
	public function testCanCreateAnObjectByAddingDaysToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->addDays($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::subDays
	 */
	public function testCanCreateAnObjectBySubtractingDaysFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->subDays($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::addWeeks
	 */
	public function testCanCreateAnObjectByAddingWeeksToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->addWeeks($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::subWeeks
	 */
	public function testCanCreateAnObjectBySubtractingWeeksFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->subWeeks($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::addMonths
	 */
	public function testCanCreateAnObjectByAddingMonthsToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->addMonths($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::subMonths
	 */
	public function testCanCreateAnObjectBySubtractingMonthsFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->subMonths($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::addYears
	 */
	public function testCanCreateAnObjectByAddingYearsToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->addYears($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::subYears
	 */
	public function testCanCreateAnObjectBySubtractingYearsFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->subYears($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::addSeconds
	 */
	public function testCanCreateAnObjectByAddingSecondsToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->addSeconds($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::subSeconds
	 */
	public function testCanCreateAnObjectBySubtractingSecondsFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->subSeconds($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::addMinutes
	 */
	public function testCanCreateAnObjectByAddingMinutesToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->addMinutes($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::subMinutes
	 */
	public function testCanCreateAnObjectBySubtractingMinutesFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->subMinutes($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::addHours
	 */
	public function testCanCreateAnObjectByAddingHoursToIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->addHours($value));
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::subHours
	 */
	public function testCanCreateAnObjectBySubtractingHoursFromIt(DateTime $sut, $value, DateTime $expected)
	{
		$this->assertEqualsWithoutChangingSUT($sut, $expected, $sut->subHours($value));
	}

	/**
	 * Testin startOfDay.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheStartOfADay()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-07-15 00:00:00'), $date->startOfDay());
	}

	/**
	 * Testing endOfDay.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfADay()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-07-15 23:59:59'), $date->endOfDay());
	}

	/**
	 * Testing startOfWeek.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheStartOfAWeek()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-07-14 00:00:00'), $date->startOfWeek());
	}

	/**
	 * Testing endOfWeek.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAWeek()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-07-20 23:59:59'), $date->endOfWeek());
	}

	/**
	 * Testing startOfMonth.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheStartOfAMonth()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-07-01 00:00:00'), $date->startOfMonth());
	}

	/**
	 * Testing endOfMonth.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAMonth()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-07-31 23:59:59'), $date->endOfMonth());
	}

	/**
	 * Testing startOfYear.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheStartOfAYear()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-01-01 00:00:00'), $date->startOfYear());
	}

	/**
	 * Testing endOfYear.
	 *
	 * @return void
	 */
	public function testCanCreateAnObjectForTheEndOfAYear()
	{
		$date = new DateTime('2014-07-15 21:14:25');
		$this->assertEqualsWithoutChangingSUT($date, new DateTime('2014-12-31 23:59:59'), $date->endOfYear());
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::since
	 */
	public function testCanCreateAStringOfATimeDifference($detailLevel, DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->since($since, $detailLevel));
	}

	/**
	 * Testing since for polish.
	 *
	 * @param   integer   $detailLevel  A level of details for since method.
	 * @param   DateTime  $since        DateTime to test.
	 * @param   DateTime  $sut          DateTime to test.
	 * @param   string    $string       An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::since_pl
	 */
	public function testCanCreateAStringOfATimeDifferenceInPolishLanguage($detailLevel, DateTime $since, DateTime $sut, $string)
	{
		DateTime::setLocale('pl');
		$this->assertEquals($string, $sut->since($since, $detailLevel));
	}

	/**
	 * Testing sinceAlmost.
	 *
	 * @param   DateTime  $since   DateTime to test.
	 * @param   DateTime  $sut     DateTime to test.
	 * @param   string    $string  An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::sinceAlmost
	 */
	public function testCanCreateAStringOfAlmostTimeDifference(DateTime $since, DateTime $sut, $string)
	{
		$this->assertEquals($string, $sut->sinceAlmost($since));
	}

	/**
	 * Testing sinceAlmost for polish.
	 *
	 * @param   DateTime  $since   DateTime to test.
	 * @param   DateTime  $sut     DateTime to test.
	 * @param   string    $string  An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::sinceAlmost_pl
	 */
	public function testCanCreateAStringOfAlmostTimeDifferenceInPolishLanguage(DateTime $since, DateTime $sut, $string)
	{
		DateTime::setLocale('pl');
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
		$timestamp = 1408838400 - $date->getOffset();
		$this->assertEquals($timestamp, $date->getTimestamp());
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
	public function testCanReturnACopyOfPhpDatetimeObject()
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::DateTimeGetter
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::DummyGetter
	 */
	public function testCanBeEasilyExtendedByCustomProperties(DateTime $datetime, $property, $propertyValue)
	{
		DateTime::setGetter(new Fixture\DummyGetter(new DateTimeGetter));
		$this->assertEquals($propertyValue, $datetime->$property);
	}

	/**
	 * Testing a default parser.
	 *
	 * @return void
	 */
	public function testThereIsNoDefaultParserMethod()
	{
		$this->setExpectedException('BadMethodCallException');
		DateTime::parse('iDoNotExist', 'iDoNotExist');
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
	 * @dataProvider Joomla\DateTime\Test\Fixture\DataProviderForDateTime::DummyParser
	 */
	public function testCanBeEasilyExtendedByCustomParsers($name, $value, DateTime $expected)
	{
		DateTime::setParser(new Fixture\DummyParser);
		$this->assertEquals($expected, DateTime::parse($name, $value));
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
	private function assertEqualsWithoutChangingSUT(DateTime $sut, DateTime $expected, DateTime $actual)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}
}
