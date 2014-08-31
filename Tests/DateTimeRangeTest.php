<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Test;

use Joomla\DateTime\DateInterval;
use Joomla\DateTime\DateTime;
use Joomla\DateTime\DateTimeRange;

/**
 * Tests for DateTimeRange class.
 *
 * @since  2.0
 */
final class DateTimeRangeTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Testing __constructor.
	 *
	 * @return void
	 */
	public function testCannotCreateARangeWithIntervalBiggerThanGivenRange()
	{
		$this->setExpectedException('InvalidArgumentException');
		new DateTimeRange(new DateTime('2014-07-21 13:00'), new DateTime('2014-07-21 14:00'), new DateInterval('PT2H'));
	}

	/**
	 * Testing from.
	 *
	 * @return void
	 */
	public function testCannotCreateARangeForLessThanTwoDatesInIt()
	{
		$this->setExpectedException('InvalidArgumentException');
		DateTimeRange::from(new DateTime('2014-07-20 13:00'), 1, new DateInterval('PT1H'));
	}

	/**
	 * Testing from.
	 *
	 * @return void
	 */
	public function testCanCreateARangeFromAStartDateWithAnExactNumberOfDates()
	{
		$range = DateTimeRange::from(new DateTime('2014-07-27'), 5, new DateInterval('PT1H'));

		$this->assertEquals(
			array(
				new DateTime('2014-07-27 00:00:00'), new DateTime('2014-07-27 01:00:00'), new DateTime('2014-07-27 02:00:00'),
				new DateTime('2014-07-27 03:00:00'), new DateTime('2014-07-27 04:00:00'),
			), $range->toArray()
		);
	}

	/**
	 * Testing to.
	 *
	 * @return void
	 */
	public function testCanCreateARangeToAnEndDateWithAnExactNumberOfDates()
	{
		$range = DateTimeRange::to(new DateTime('2014-07-27'), 5, new DateInterval('PT1H'));

		$this->assertEquals(
			array(
				new DateTime('2014-07-26 20:00:00'), new DateTime('2014-07-26 21:00:00'), new DateTime('2014-07-26 22:00:00'),
				new DateTime('2014-07-26 23:00:00'), new DateTime('2014-07-27 00:00:00'),
			), $range->toArray()
		);
	}

	/**
	 * Testing emptyRange.
	 *
	 * @return void
	 */
	public function testCanCreateAnEmptyRange()
	{
		$range = DateTimeRange::emptyRange();
		$this->assertTrue($range->isEmpty());
	}

	/**
	 * Testing equals.
	 *
	 * @return void
	 */
	public function testCanDetermineIfTwoRangesAreEqual()
	{
		$range = new DateTimeRange(new DateTime('2014-06-12 13:00'), new DateTime('2014-07-13 9:00'), new DateInterval('PT1H'));

		$this->assertTrue($range->equals(new DateTimeRange(new DateTime('2014-06-12 13:00'), new DateTime('2014-07-13 9:00'), new DateInterval('PT1H'))));
		$this->assertFalse($range->equals(new DateTimeRange(new DateTime('2014-06-12 13:00'), new DateTime('2014-07-13 9:00'), new DateInterval('PT2H'))));
		$this->assertFalse($range->equals(new DateTimeRange(new DateTime('2014-06-12 13:00'), new DateTime('2014-07-13 10:00'), new DateInterval('PT1H'))));
	}

	/**
	 * Testing includes.
	 *
	 * @param   boolean        $includes  Does date include into a range?
	 * @param   DateTimeRange  $sut       DateTimeRange to test.
	 * @param   DateTime       $date      DateTime to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForIncludesADate
	 */
	public function testCanDetermineIfADateIncludesIntoARange($includes, DateTimeRange $sut, DateTime $date)
	{
		if ($includes)
		{
			$this->assertTrue($sut->includes($date));
		}
		else
		{
			$this->assertFalse($sut->includes($date));
		}
	}

	/**
	 * Testing overlaps.
	 *
	 * @param   boolean        $overlaps  Does one range overlaps with another range?
	 * @param   DateTimeRange  $sut       DateTimeRange to test.
	 * @param   DateTimeRange  $range     DateTimeRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForOverlaps
	 */
	public function testCanDetermineIfOneRangeOverlapsWithAnotherOne($overlaps, DateTimeRange $sut, DateTimeRange $range)
	{
		if ($overlaps)
		{
			$this->assertTrue($sut->overlaps($range));
		}
		else
		{
			$this->assertFalse($sut->overlaps($range));
		}
	}

	/**
	 * Testing includesRange.
	 *
	 * @param   boolean        $includes  Does one range inludesc into another range?
	 * @param   DateTimeRange  $sut       DateTimeRange to test.
	 * @param   DateTimeRange  $range     DateTimeRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForIncludesARange
	 */
	public function testCanDetermineIfOneRangeIncludesAnotherOne($includes, DateTimeRange $sut, DateTimeRange $range)
	{
		if ($includes)
		{
			$this->assertTrue($sut->includesRange($range));
		}
		else
		{
			$this->assertFalse($sut->includesRange($range));
		}
	}

	/**
	 * Testing gap.
	 *
	 * @param   DateTimeRange  $sut    DateTimeRange to test.
	 * @param   DateTimeRange  $range  DateTimeRange to test.
	 * @param   DateTimeRange  $gap    DateTimeRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForGap
	 */
	public function testCanCreateAGapRangeBetweenTwoRanges(DateTimeRange $sut, DateTimeRange $range, DateTimeRange $gap)
	{
		$this->assertEquals($gap, $sut->gap($range));
	}

	/**
	 * Testing abuts.
	 *
	 * @param   boolean        $abuts  Does one range abuts with another range?
	 * @param   DateTimeRange  $sut    DateTimeRange to test.
	 * @param   DateTimeRange  $range  DateTimeRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAbuts
	 */
	public function testCanDetermineIfTwoRangesAbutWithEachOther($abuts, DateTimeRange $sut, DateTimeRange $range)
	{
		if ($abuts)
		{
			$this->assertTrue($sut->abuts($range));
		}
		else
		{
			$this->assertFalse($sut->abuts($range));
		}
	}

	/**
	 * Testing isContiguous
	 *
	 * @param   boolean  $contiguous  Does an array of ranges is contiguous?
	 * @param   array    $ranges      An array of ranges to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForIsContiguous
	 */
	public function testCanDetermineIfRangesAreContiguous($contiguous, array $ranges)
	{
		if ($contiguous)
		{
			$this->assertTrue(DateTimeRange::isContiguous($ranges));
		}
		else
		{
			$this->assertFalse(DateTimeRange::isContiguous($ranges));
		}
	}

	/**
	 * Testing isContigous when ranges have a different interval
	 *
	 * @return void
	 */
	public function testWillThrowAnExceptionIfRangesHaveADifferentIntervalDuringCombination()
	{
		$this->setExpectedException("InvalidArgumentException");
		DateTimeRange::isContiguous(
			array(
				new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-12'), new DateInterval('PT1H')),
				new DateTimeRange(new DateTime('2014-06-13'), new DateTime('2014-06-15'), new DateInterval('PT2H'))
			)
		);
	}

	/**
	 * Testing combination.
	 *
	 * @param   DateTimeRange  $result  Combination of date ranges from an array.
	 * @param   array          $ranges  An array of ranges to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForCombination
	 */
	public function testCanCombineManyContiguousRangesIntoOne(DateTimeRange $result, array $ranges)
	{
		$this->assertEquals($result, DateTimeRange::combination($ranges));
	}

	/**
	 * Testing combination when ranges are not contiguous
	 *
	 * @param   array  $ranges  An array of ranges to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForCombinationWithNotContigousRanges
	 */
	public function testWillThrowAnExceptionIfRangesAreNotContiguousDuringCombination(array $ranges)
	{
		$this->setExpectedException("InvalidArgumentException");
		DateTimeRange::combination($ranges);
	}

	/**
	 * Testing toArray().
	 *
	 * @param   DateTimeRange  $range     Object to test.
	 * @param   array          $expected  An expected array.
	 *
	 * @return void
	 *
	 * @dataProvider seedForToArray
	 */
	public function testCanReturnAnArrayOfDateTimeObjectsIncludedInARange(DateTimeRange $range, $expected)
	{
		$this->assertEquals($expected, $range->toArray());
	}

	/**
	 * Testing toString.
	 *
	 * @return void
	 */
	public function testCanCastToString()
	{
		$range = new DateTimeRange(new DateTime('2014-05-19 12:00'), new DateTime('2014-08-15 20:00'), new DateInterval('PT1H'));

		$this->assertSame('2014-05-19 12:00:00 - 2014-08-15 20:00:00', (string) $range);
	}

	/**
	 * Test cases for includes.
	 *
	 * @return array
	 */
	public function seedForIncludesADate()
	{
		$start = new DateTime('2014-06-12');
		$end = new DateTime('2014-07-13');

		$range = new DateTimeRange($start, $end, new DateInterval('PT1H'));

		return array(
			array(true, $range, $start),
			array(true, $range, new DateTime('2014-06-28')),
			array(true, $range, $end),
			array(false, $range, $start->subDays(1)),
			array(false, $range, $end->addDays(1))
		);
	}

	/**
	 * Test cases for overlaps.
	 *
	 * @return array
	 */
	public function seedForOverlaps()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 20:00'), new DateInterval('PT1H'));

		return array(
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 08:00'), new DateTime('2014-06-10 09:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 9:00'), new DateTime('2014-06-10 10:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 9:00'), new DateTime('2014-06-10 11:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 11:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 14:00'), new DateTime('2014-06-10 16:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 19:00'), new DateTime('2014-06-10 20:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 19:00'), new DateTime('2014-06-10 21:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 20:00'), new DateTime('2014-06-10 21:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 21:00'), new DateTime('2014-06-10 22:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 09:00'), new DateTime('2014-06-10 21:00'), new DateInterval('PT1H'))),
		);
	}

	/**
	 * Test cases for includesRange.
	 *
	 * @return array
	 */
	public function seedForIncludesARange()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 20:00'), new DateInterval('PT1H'));

		return array(
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 08:00'), new DateTime('2014-06-10 09:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 09:00'), new DateTime('2014-06-10 10:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 09:00'), new DateTime('2014-06-10 11:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 11:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 14:00'), new DateTime('2014-06-10 16:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 19:00'), new DateTime('2014-06-10 20:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 19:00'), new DateTime('2014-06-10 21:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 20:00'), new DateTime('2014-06-10 21:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 21:00'), new DateTime('2014-06-10 22:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 09:00'), new DateTime('2014-06-10 21:00'), new DateInterval('PT1H'))),
		);
	}

	/**
	 * Test cases for gap.
	 *
	 * @return array
	 */
	public function seedForGap()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 13:00'), new DateInterval('PT1H'));

		return array(
			array($sut, new DateTimeRange(new DateTime('2014-06-10 07:00'), new DateTime('2014-06-10 08:00'), new DateInterval('PT1H')),
						new DateTimeRange(new DateTime('2014-06-10 09:00'), new DateTime('2014-06-10 09:00'), new DateInterval('PT1H'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-10 16:00'), new DateTime('2014-06-10 17:00'), new DateInterval('PT1H')),
						new DateTimeRange(new DateTime('2014-06-10 14:00'), new DateTime('2014-06-10 15:00'), new DateInterval('PT1H'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-10 12:00'), new DateTime('2014-06-10 17:00'), new DateInterval('PT1H')),
						DateTimeRange::emptyRange())
		);
	}

	/**
	 * Test cases for abuts.
	 *
	 * @return array
	 */
	public function seedForAbuts()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 13:00'), new DateInterval('PT1H'));

		return array(
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 13:00'), new DateTime('2014-06-10 15:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 14:00'), new DateTime('2014-06-10 15:00'), new DateInterval('PT1H'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-10 08:00'), new DateTime('2014-06-10 10:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 08:00'), new DateTime('2014-06-10 09:00'), new DateInterval('PT1H'))),
			array(true, $sut, new DateTimeRange(new DateTime('2014-06-10 08:00'), new DateTime('2014-06-10 09:00'), new DateInterval('PT1H'))),
		);
	}

	/**
	 * Test cases for isContiguous.
	 *
	 * @return array
	 */
	public function seedForIsContiguous()
	{
		return array(
			array(true, array(
					new DateTimeRange(new DateTime('2014-06-10 12:00'), new DateTime('2014-06-10 13:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-06-10 14:00'), new DateTime('2014-06-10 16:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-06-10 17:00'), new DateTime('2014-06-10 18:00'), new DateInterval('PT1H'))
				)),
			array(false, array(
					new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 12:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-06-10 12:00'), new DateTime('2014-06-10 15:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-06-10 16:00'), new DateTime('2014-06-10 18:00'), new DateInterval('PT1H'))
				))
		);
	}

	/**
	 * Test cases for combination.
	 *
	 * @return array
	 */
	public function seedForCombination()
	{
		return array(
			array(
				new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-12 18:00'), new DateInterval('PT1H')),
				array(
					new DateTimeRange(new DateTime('2014-06-10 10:00'), new DateTime('2014-06-10 18:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-06-10 19:00'), new DateTime('2014-06-12 11:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-06-12 12:00'), new DateTime('2014-06-12 18:00'), new DateInterval('PT1H'))
				)
			),
		);
	}

	/**
	 * Test cases for combination.
	 *
	 * @return array
	 */
	public function seedForCombinationWithNotContigousRanges()
	{
		return array(
			array(
				array(
					new DateTimeRange(new DateTime('2014-07-10 15:00'), new DateTime('2014-07-10 16:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-07-10 21:00'), new DateTime('2014-07-10 23:00'), new DateInterval('PT1H')))),
			array(
				array(
					new DateTimeRange(DateTime::today(), DateTime::tomorrow(), new DateInterval('PT1H')),
					new DateTimeRange(DateTime::today(), DateTime::tomorrow(), new DateInterval('PT1H')))),
			array(
				array(
					new DateTimeRange(new DateTime('2014-07-10 16:00'), new DateTime('2014-07-10 23:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-07-10 15:00'), new DateTime('2014-07-10 20:00'), new DateInterval('PT1H')))),
			array(
				array(
					new DateTimeRange(new DateTime('2014-07-10 15:00'), new DateTime('2014-07-10 23:00'), new DateInterval('PT1H')),
					new DateTimeRange(new DateTime('2014-07-10 15:00'), new DateTime('2014-07-10 20:00'), new DateInterval('PT1H')))),
		);
	}

	/**
	 * Test cases for toArray.
	 *
	 * @return array
	 */
	public function seedForToArray()
	{
		$day = new DateTimeRange(new DateTime('2014-07-27'), new DateTime('2014-08-06'), new DateInterval('P2D'));
		$week = new DateTimeRange(new DateTime('2014-07-27'), new DateTime('2014-08-30'), new DateInterval('P2W'));
		$month = new DateTimeRange(new DateTime('2014-07-27'), new DateTime('2015-02-05'), new DateInterval('P3M'));
		$year = new DateTimeRange(new DateTime('2014-07-27'), new DateTime('2017-02-05'), new DateInterval('P1Y'));
		$second = new DateTimeRange(new DateTime('2014-07-27 12:00:00'), new DateTime('2014-07-27 12:00:06'), new DateInterval('PT2S'));

		return array(
			array($day, array(new DateTime('2014-07-27'), new DateTime('2014-07-29'), new DateTime('2014-07-31'),
					new DateTime('2014-08-02'), new DateTime('2014-08-04'), new DateTime('2014-08-06'))),
			array($week, array(new DateTime('2014-07-27'), new DateTime('2014-08-10'), new DateTime('2014-08-24'))),
			array($month, array(new DateTime('2014-07-27'), new DateTime('2014-10-27'), new DateTime('2015-01-27'))),
			array($year, array(new DateTime('2014-07-27'), new DateTime('2015-07-27'), new DateTime('2016-07-27'))),
			array($second, array(new DateTime('2014-07-27 12:00:00'), new DateTime('2014-07-27 12:00:02'),
					new DateTime('2014-07-27 12:00:04'), new DateTime('2014-07-27 12:00:06')))
		);
	}
}
