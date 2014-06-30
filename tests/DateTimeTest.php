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

	/**
	 * Set up fixtures
	 *
	 * @return void
	 */
	protected function setUp()
	{
		$this->SUT = new DateTime(self::CURRENT);
	}

	/**
	 * @test
	 * @dataProvider seedWithDateTimeObject
	 */
	public function it_should_create_a_new_object(DateTime $sut, DateTime $expected)
	{
		$this->assertEquals($expected, $sut);
	}

	/** @test */
	public function it_should_equals_two_object()
	{
		$this->assertTrue($this->SUT->equals(new DateTime(self::CURRENT)));
		$this->assertFalse($this->SUT->equals($this->SUT->addSeconds(1)));
	}

	/** @test */
	public function it_should_check_that_date_is_after_the_other_one()
	{
		$this->assertTrue($this->SUT->after($this->SUT->subSeconds(1)));
	}

	/** @test */
	public function it_should_check_that_date_is_before_the_other_one()
	{
		$this->assertTrue($this->SUT->before($this->SUT->addSeconds(1)));
	}

	/** @test */
	public function it_should_return_a_new_instance_with_added_interval()
	{
		$current = clone $this->SUT;
		$added = $this->SUT->add(new \DateInterval('P1D'));

		$this->assertNotEquals($added, $this->SUT);
		$this->assertEquals($current, $this->SUT);
		$this->assertEquals($added->format(self::FORMAT), self::ADDED_1_DAY);
	}

	/** @test */
	public function it_should_return_a_new_instance_with_subed_interval()
	{
		$current = clone $this->SUT;
		$subed = $this->SUT->sub(new \DateInterval('P1D'));

		$this->assertNotEquals($subed, $this->SUT);
		$this->assertEquals($current, $this->SUT);
		$this->assertEquals($subed->format(self::FORMAT), self::SUBED_1_DAY);
	}

	/**
	 * @test
	 * @dataProvider seedWithDateTimesForCalculations
	 */
	public function it_should_return_a_new_instance_of_an_object($sut, $actual, $expected)
	{
		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($actual, $sut);
	}

	/** @test */
	public function it_should_return_a_new_instance_of_php_datetime_object()
	{
		$this->assertAttributeNotSame($this->SUT->getDateTime(), 'datetime', $this->SUT);
	}

	/** @test */
	public function it_should_return_a_string_for_a_time_difference()
	{
		$sut = DateTime::now();
		$sut = $sut->addSeconds(-1);

		$this->assertEquals('', $sut->timeSince());
	}

	public function seedWithDateTimeObject()
	{
		return array(
			array(DateTime::create('2014', '06', '12', '08', '04', '09'), new DateTime('2014-06-12 08:04:09')),
			array(DateTime::create(2014, 6, 12, 8, 4, 9),	new DateTime('2014-06-12 08:04:09')),
			array(DateTime::create(2014, 6, 12, 8, 4),		new DateTime('2014-06-12 08:04:00')),
			array(DateTime::create(2014, 6, 12, 8),			new DateTime('2014-06-12 08:00:00')),
			array(DateTime::create(2014, 6, 12),			new DateTime('2014-06-12 00:00:00')),
			array(DateTime::create(2014, 6),				new DateTime('2014-06-01 00:00:00')),
			array(DateTime::create(2014),					new DateTime('2014-01-01 00:00:00')),
			array(DateTime::createFromDate(2014, 6, 12),	new DateTime('2014-06-12 00:00:00')),
			array(DateTime::createFromDate(2014, 6),		new DateTime('2014-06-01 00:00:00')),
			array(DateTime::createFromDate(2014),			new DateTime('2014-01-01 00:00:00')),
			array(DateTime::createFromTime(8, 4, 9),		new DateTime(sprintf('%s 08:04:09', date('Y-m-d')))),
			array(DateTime::createFromTime(8, 4),			new DateTime(sprintf('%s 08:04:00', date('Y-m-d')))),
			array(DateTime::createFromTime(8),				new DateTime(sprintf('%s 08:00:00', date('Y-m-d')))),
			array(DateTime::now(),							new DateTime(date('Y-m-d H:i:s'))),
			array(DateTime::today(),						new DateTime(sprintf('%s-%s 00:00:00', date('Y-m'), date('d')))),
			array(DateTime::yesterday(),					new DateTime(sprintf('%s-%s 00:00:00', date('Y-m'), date('d') - 1))),
			array(DateTime::tomorrow(),						new DateTime(sprintf('%s-%s 00:00:00', date('Y-m'), date('d') + 1)))
		);
	}

	public function seedWithDateTimesForCalculations()
	{
		$sut = new DateTime(self::CURRENT);

		return array(
			array($sut, $sut->addDays(1), $sut->add(new \DateInterval('P1D'))),
			array($sut, $sut->subDays(1), $sut->sub(new \DateInterval('P1D'))),
			array($sut, $sut->subDays(-1), $sut->add(new \DateInterval('P1D'))),
			array($sut, $sut->addDays(-1), $sut->sub(new \DateInterval('P1D'))),
			array($sut, $sut->addWeeks(1), $sut->add(new \DateInterval('P1W'))),
			array($sut, $sut->subWeeks(1), $sut->sub(new \DateInterval('P1W'))),
			array($sut, $sut->subWeeks(-1), $sut->add(new \DateInterval('P1W'))),
			array($sut, $sut->addWeeks(-1), $sut->sub(new \DateInterval('P1W'))),
			array($sut, $sut->addMonths(1), $sut->add(new \DateInterval('P1M'))),
			array($sut, $sut->subMonths(1), $sut->sub(new \DateInterval('P1M'))),						#10
			array($sut, $sut->subMonths(-1), $sut->add(new \DateInterval('P1M'))),
			array($sut, $sut->addMonths(-1), $sut->sub(new \DateInterval('P1M'))),
			array($sut, $sut->addYears(1), $sut->add(new \DateInterval('P1Y'))),
			array($sut, $sut->subYears(1), $sut->sub(new \DateInterval('P1Y'))),
			array($sut, $sut->subYears(-1), $sut->add(new \DateInterval('P1Y'))),
			array($sut, $sut->addYears(-1), $sut->sub(new \DateInterval('P1Y'))),
			array($sut, $sut->addSeconds(1), $sut->add(new \DateInterval('PT1S'))),
			array($sut, $sut->subSeconds(1), $sut->sub(new \DateInterval('PT1S'))),
			array($sut, $sut->subSeconds(-1), $sut->add(new \DateInterval('PT1S'))),
			array($sut, $sut->addSeconds(-1), $sut->sub(new \DateInterval('PT1S'))),					#20
			array($sut, $sut->addMinutes(1), $sut->add(new \DateInterval('PT1M'))),
			array($sut, $sut->subMinutes(1), $sut->sub(new \DateInterval('PT1M'))),
			array($sut, $sut->subMinutes(-1), $sut->add(new \DateInterval('PT1M'))),
			array($sut, $sut->addMinutes(-1), $sut->sub(new \DateInterval('PT1M'))),
			array($sut, $sut->addHours(1), $sut->add(new \DateInterval('PT1H'))),
			array($sut, $sut->subHours(1), $sut->sub(new \DateInterval('PT1H'))),
			array($sut, $sut->subHours(-1), $sut->add(new \DateInterval('PT1H'))),
			array($sut, $sut->addHours(-1), $sut->sub(new \DateInterval('PT1H'))),
			array($sut, $sut->beginOfDay(), new DateTime($sut->format('Y-m-d 00:00:00'))),
			array($sut, $sut->endOfDay(), new DateTime($sut->format('Y-m-d 23:59:59'))),				#30
			array($sut, $sut->beginOfWeek(), new DateTime('2014-05-19 00:00:00')),
			array($sut, $sut->endOfWeek(), new DateTime('2014-05-25 23:59:59')),
			array($sut, $sut->beginOfMonth(), new DateTime($sut->format('Y-m-01 00:00:00'))),
			array($sut, $sut->endOfMonth(), new DateTime($sut->format('Y-m-31 23:59:59'))),
			array($sut, $sut->beginOfYear(), new DateTime($sut->format('Y-01-01 00:00:00'))),
			array($sut, $sut->endOfYear(), new DateTime($sut->format('Y-12-31 23:59:59')))
		);
	}
}
