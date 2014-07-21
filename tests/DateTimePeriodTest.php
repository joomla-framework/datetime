<?php

namespace Joomla\DateTime;

final class DateTimePeriodTest extends \PHPUnit_Framework_TestCase
{
    public function testCannotCreateAPeriodFromEndToStart()
    {
		$this->setExpectedException('\InvalidArgumentException');
		new DateTimePeriod(new DateTime('2014-07-21'), new DateTime('2014-07-10'), new \DateInterval('P2D'));
    }

	public function testCannotCreateAPeriodForIntervalBiggerThanGivenPeriod()
    {
		$this->setExpectedException('\InvalidArgumentException');
		new DateTimePeriod(new DateTime('2014-07-21'), new DateTime('2014-07-22'), new \DateInterval('P2D'));
    }

	/**
	 * @dataProvider seedForToArray
	 */
	public function testCanCreateAnArrayOfDateTimeOnObjectsForGivenInterval(DateTimePeriod $period, $expected)
    {
		$this->assertEquals($expected, $period->toArray());
    }

	public function testCannotCreateAPeriodForLessThanTwoDatesInIt()
	{
		$this->setExpectedException('\InvalidArgumentException');
		DateTimePeriod::from(new DateTime('2014-07-20'), 1, new \DateInterval('PT1H'));
	}

	public function testCanCreateAPeriodForAStartDateWithAnExactNumberOfDatesInIt()
    {
		$period = DateTimePeriod::from(new DateTime('2014-07-27'), 5, new \DateInterval('PT1H'));

		$this->assertEquals(array(
				new DateTime('2014-07-27 00:00:00'), new DateTime('2014-07-27 01:00:00'), new DateTime('2014-07-27 02:00:00'),
				new DateTime('2014-07-27 03:00:00'), new DateTime('2014-07-27 04:00:00'),
			), $period->toArray());
    }

	public function testCanCreateAPeriodForAnEndDateWithAnExactNumberOfDatesInIt()
    {
		$period = DateTimePeriod::to(new DateTime('2014-07-27'), 5, new \DateInterval('PT1H'));

		$this->assertEquals(array(
				new DateTime('2014-07-26 20:00:00'), new DateTime('2014-07-26 21:00:00'), new DateTime('2014-07-26 22:00:00'),
				new DateTime('2014-07-26 23:00:00'), new DateTime('2014-07-27 00:00:00'),
			), $period->toArray());
    }

	public function seedForToArray()
	{
		$day	= new DateTimePeriod(new DateTime('2014-07-27'), new DateTime('2014-08-06'), new \DateInterval('P2D'));
		$week	= new DateTimePeriod(new DateTime('2014-07-27'), new DateTime('2014-08-30'), new \DateInterval('P2W'));
		$month	= new DateTimePeriod(new DateTime('2014-07-27'), new DateTime('2015-02-05'), new \DateInterval('P3M'));
		$year	= new DateTimePeriod(new DateTime('2014-07-27'), new DateTime('2017-02-05'), new \DateInterval('P1Y'));
		$second = new DateTimePeriod(new DateTime('2014-07-27 12:00:00'), new DateTime('2014-07-27 12:00:06'), new \DateInterval('PT2S'));

		return array(
			array($day,    array(new DateTime('2014-07-27'), new DateTime('2014-07-29'), new DateTime('2014-07-31'),
							     new DateTime('2014-08-02'), new DateTime('2014-08-04'), new DateTime('2014-08-06'))),
			array($week,   array(new DateTime('2014-07-27'), new DateTime('2014-08-10'), new DateTime('2014-08-24'))),
			array($month,  array(new DateTime('2014-07-27'), new DateTime('2014-10-27'), new DateTime('2015-01-27'))),
			array($year,   array(new DateTime('2014-07-27'), new DateTime('2015-07-27'), new DateTime('2016-07-27'))),
			array($second, array(new DateTime('2014-07-27 12:00:00'), new DateTime('2014-07-27 12:00:02'),
				                 new DateTime('2014-07-27 12:00:04'), new DateTime('2014-07-27 12:00:06')))
		);
	}

}