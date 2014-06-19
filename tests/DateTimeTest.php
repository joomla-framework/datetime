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
class DateTimeTest extends \PHPUnit_Framework_TestCase
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
	public function it_should_create_a_new_object(DateTime $sut, $expected)
	{
		$this->assertEquals($expected, $sut->format(self::FORMAT));
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
		$this->assertEquals(-1, intval('-1'));

		$this->assertAttributeNotSame($this->SUT->toDateTime(), 'datetime', $this->SUT);
	}

	public function seedWithDateTimeObject()
	{
		return array(
			array(DateTime::createFromDateTime('2014', '06', '12', '08', '04', '09'), '2014-06-12 08:04:09'),
			array(DateTime::createFromDateTime(2014, 6, 12, 8, 4, 9),	'2014-06-12 08:04:09'),
			array(DateTime::createFromDateTime(2014, 6, 12, 8, 4),		'2014-06-12 08:04:00'),
			array(DateTime::createFromDateTime(2014, 6, 12, 8),			'2014-06-12 08:00:00'),
			array(DateTime::createFromDateTime(2014, 6, 12),			'2014-06-12 00:00:00'),
			array(DateTime::createFromDateTime(2014, 6),				'2014-06-01 00:00:00'),
			array(DateTime::createFromDateTime(2014),					'2014-01-01 00:00:00'),
			array(DateTime::createFromDate(2014, 6, 12),				'2014-06-12 00:00:00'),
			array(DateTime::createFromDate(2014, 6),					'2014-06-01 00:00:00'),
			array(DateTime::createFromDate(2014),						'2014-01-01 00:00:00'),
			array(DateTime::createFromTime(8, 4, 9),					sprintf('%s-%s-%s 08:04:09', date('Y'), date('m'), date('d'))),
			array(DateTime::createFromTime(8, 4),						sprintf('%s-%s-%s 08:04:00', date('Y'), date('m'), date('d'))),
			array(DateTime::createFromTime(8),							sprintf('%s-%s-%s 08:00:00', date('Y'), date('m'), date('d')))
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
			array($sut, $sut->addMonths(1), $sut->add(new \DateInterval('P1M'))),
			array($sut, $sut->subMonths(1), $sut->sub(new \DateInterval('P1M'))),
			array($sut, $sut->subMonths(-1), $sut->add(new \DateInterval('P1M'))),
			array($sut, $sut->addMonths(-1), $sut->sub(new \DateInterval('P1M'))),
			array($sut, $sut->addYears(1), $sut->add(new \DateInterval('P1Y'))),
			array($sut, $sut->subYears(1), $sut->sub(new \DateInterval('P1Y'))),
			array($sut, $sut->subYears(-1), $sut->add(new \DateInterval('P1Y'))),
			array($sut, $sut->addYears(-1), $sut->sub(new \DateInterval('P1Y'))),
			array($sut, $sut->addSeconds(1), $sut->add(new \DateInterval('PT1S'))),
			array($sut, $sut->subSeconds(1), $sut->sub(new \DateInterval('PT1S'))),
			array($sut, $sut->subSeconds(-1), $sut->add(new \DateInterval('PT1S'))),
			array($sut, $sut->addSeconds(-1), $sut->sub(new \DateInterval('PT1S'))),
			array($sut, $sut->addMinutes(1), $sut->add(new \DateInterval('PT1M'))),
			array($sut, $sut->subMinutes(1), $sut->sub(new \DateInterval('PT1M'))),
			array($sut, $sut->subMinutes(-1), $sut->add(new \DateInterval('PT1M'))),
			array($sut, $sut->addMinutes(-1), $sut->sub(new \DateInterval('PT1M'))),
			array($sut, $sut->addHours(1), $sut->add(new \DateInterval('PT1H'))),
			array($sut, $sut->subHours(1), $sut->sub(new \DateInterval('PT1H'))),
			array($sut, $sut->subHours(-1), $sut->add(new \DateInterval('PT1H'))),
			array($sut, $sut->addHours(-1), $sut->sub(new \DateInterval('PT1H'))),
		);
	}
}
