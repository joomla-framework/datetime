<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Tests for DateRange class.
 *
 * @since  2.0
 */
final class DateRangeTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Testing from.
	 *
	 * @return void
	 */
	public function testCanCreateARangeFromAStartDateWithAnExactNumberOfDays()
	{
		$range = DateRange::from(new Date('2014-07-27'), 5);

		$this->assertEquals(
			array(
				new Date('2014-07-27'), new Date('2014-07-28'), new Date('2014-07-29'),
				new Date('2014-07-30'), new Date('2014-07-31'),
			), $range->toArray()
		);
	}

	/**
	 * Testing to.
	 *
	 * @return void
	 */
	public function testCanCreateARangeToAnEndDateWithAnExactNumberOfDays()
	{
		$range = DateRange::to(new Date('2014-07-27'), 5);

		$this->assertEquals(
			array(
				new Date('2014-07-23'), new Date('2014-07-24'), new Date('2014-07-25'),
				new Date('2014-07-26'), new Date('2014-07-27'),
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
		$range = DateRange::emptyRange();
		$this->assertTrue($range->isEmpty());
	}

	/**
	 * Testing gap.
	 *
	 * @param   DateRange  $sut    DateRange to test.
	 * @param   DateRange  $range  DateRange to test.
	 * @param   DateRange  $gap    DateRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForGap
	 */
	public function testCanCreateAGapRangeBetweenTwoRanges(DateRange $sut, DateRange $range, DateRange $gap)
	{
		$this->assertEquals($gap, $sut->gap($range));
	}

	/**
	 * Testing isEmpty.
	 *
	 * @return void
	 */
	public function testCanDetermineIfARangeIsEmpty()
	{
		$range = new DateRange(Date::tomorrow(), Date::yesterday());
		$this->assertTrue($range->isEmpty());
	}

	/**
	 * Testing equals.
	 *
	 * @return void
	 */
	public function testCanDetermineIfTwoRangesAreEqual()
	{
		$range = new DateRange(new Date('2014-06-12'), new Date('2014-07-13'));

		$this->assertTrue($range->equals(new DateRange(new Date('2014-06-12'), new Date('2014-07-13'))));
		$this->assertFalse($range->equals(new DateRange(new Date('2014-06-12'), new Date('2014-07-12'))));
	}

	/**
	 * Testing includes.
	 *
	 * @param   boolean    $includes  Does date include into a range?
	 * @param   DateRange  $sut       DateRange to test.
	 * @param   Date       $date      Date to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForIncludesADate
	 */
	public function testCanDetermineIfADateIncludesIntoARange($includes, DateRange $sut, Date $date)
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
	 * @param   boolean    $overlaps  Does one range overlaps with another range?
	 * @param   DateRange  $sut       DateRange to test.
	 * @param   DateRange  $range     DateRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForOverlaps
	 */
	public function testCanDetermineIfOneRangeOverlapsWithAnother($overlaps, DateRange $sut, DateRange $range)
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
	 * @param   boolean    $includes  Does one range inludesc into another range?
	 * @param   DateRange  $sut       DateRange to test.
	 * @param   DateRange  $range     DateRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForIncludesARange
	 */
	public function testCanDetermineIfOneRangeIncludesAnother($includes, DateRange $sut, DateRange $range)
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
	 * Testing abuts.
	 *
	 * @param   boolean    $abuts  Does one range abuts with another range?
	 * @param   DateRange  $sut    DateRange to test.
	 * @param   DateRange  $range  DateRange to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForAbuts
	 */
	public function testCanDetermineIfTwoRangesAbutWithEachOther($abuts, DateRange $sut, DateRange $range)
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
			$this->assertTrue(DateRange::isContiguous($ranges));
		}
		else
		{
			$this->assertFalse(DateRange::isContiguous($ranges));
		}
	}

	/**
	 * Testing combination.
	 *
	 * @param   DateRange  $result  Combination of date ranges from an array.
	 * @param   array      $ranges  An array of ranges to test.
	 *
	 * @return void
	 *
	 * @dataProvider seedForCombination
	 */
	public function testCanCombineManyContiguousRangesIntoOne(DateRange $result, array $ranges)
	{
		$this->assertEquals($result, DateRange::combination($ranges));
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
		$this->setExpectedException("\InvalidArgumentException");
		DateRange::combination($ranges);
	}

	/**
	 * Testing toArray.
	 *
	 * @return void
	 */
	public function testCanReturnAnArrayOfDatesIncludedInARange()
	{
		$range = new DateRange(new Date('2014-06-29'), new Date('2014-07-04'));

		$this->assertEquals(
			array(
				new Date('2014-06-29'), new Date('2014-06-30'), new Date('2014-07-01'),
				new Date('2014-07-02'), new Date('2014-07-03'), new Date('2014-07-04'),
			), $range->toArray()
		);
	}

	/**
	 * Testing toString.
	 *
	 * @return void
	 */
	public function testCanCastToString()
	{
		$range = new DateRange(new Date('2014-05-19'), new Date('2014-08-15'));

		$this->assertSame('2014-05-19 - 2014-08-15', (string) $range);
	}

	/**
	 * Test cases for includes.
	 *
	 * @return array
	 */
	public function seedForIncludesADate()
	{
		$start = new Date('2014-06-12');
		$end = new Date('2014-07-13');

		$range = new DateRange($start, $end);

		return array(
			array(true, $range, $start),
			array(true, $range, new Date('2014-06-28')),
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
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-20'));

		return array(
			array(false, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))),
			array(true, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-10'))),
			array(true, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-11'))),
			array(true, $sut, new DateRange(new Date('2014-06-10'), new Date('2014-06-11'))),
			array(true, $sut, new DateRange(new Date('2014-06-14'), new Date('2014-06-16'))),
			array(true, $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-20'))),
			array(true, $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-21'))),
			array(true, $sut, new DateRange(new Date('2014-06-20'), new Date('2014-06-21'))),
			array(false, $sut, new DateRange(new Date('2014-06-21'), new Date('2014-06-22'))),
			array(true, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-21'))),
		);
	}

	/**
	 * Test cases for includesRange.
	 *
	 * @return array
	 */
	public function seedForIncludesARange()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-20'));

		return array(
			array(false, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))),
			array(false, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-10'))),
			array(false, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-11'))),
			array(true, $sut, new DateRange(new Date('2014-06-10'), new Date('2014-06-11'))),
			array(true, $sut, new DateRange(new Date('2014-06-14'), new Date('2014-06-16'))),
			array(true, $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-20'))),
			array(false, $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-21'))),
			array(false, $sut, new DateRange(new Date('2014-06-20'), new Date('2014-06-21'))),
			array(false, $sut, new DateRange(new Date('2014-06-21'), new Date('2014-06-22'))),
			array(false, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-21'))),
		);
	}

	/**
	 * Test cases for gap.
	 *
	 * @return array
	 */
	public function seedForGap()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-13'));

		return array(
			array($sut, new DateRange(new Date('2014-06-07'), new Date('2014-06-08')),
						new DateRange(new Date('2014-06-09'), new Date('2014-06-09'))),
			array($sut, new DateRange(new Date('2014-06-16'), new Date('2014-06-17')),
						new DateRange(new Date('2014-06-14'), new Date('2014-06-15'))),
			array($sut, new DateRange(new Date('2014-06-12'), new Date('2014-06-17')),
						DateRange::emptyRange())
		);
	}

	/**
	 * Test cases for abuts.
	 *
	 * @return array
	 */
	public function seedForAbuts()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-13'), true);

		return array(
			array(false, $sut, new DateRange(new Date('2014-06-13'), new Date('2014-06-15'))),
			array(true, $sut, new DateRange(new Date('2014-06-14'), new Date('2014-06-15'))),
			array(false, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-10'))),
			array(true, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))),
			array(true, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))),
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
					new DateRange(new Date('2014-06-12'), new Date('2014-06-13')),
					new DateRange(new Date('2014-06-14'), new Date('2014-06-16')),
					new DateRange(new Date('2014-06-17'), new Date('2014-06-18'))
				)),
			array(false, array(
					new DateRange(new Date('2014-06-10'), new Date('2014-06-12')),
					new DateRange(new Date('2014-06-12'), new Date('2014-06-15')),
					new DateRange(new Date('2014-06-16'), new Date('2014-06-18'))
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
				new DateRange(new Date('2014-06-10'), new Date('2014-07-18')),
				array(
					new DateRange(new Date('2014-06-10'), new Date('2014-06-18')),
					new DateRange(new Date('2014-06-19'), new Date('2014-06-29')),
					new DateRange(new Date('2014-06-30'), new Date('2014-07-18'))
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
					new DateRange(new Date('2014-07-15'), new Date('2014-07-16')),
					new DateRange(new Date('2014-07-25'), new Date('2014-07-26')))),
			array(
				array(
					new DateRange(Date::today(), Date::tomorrow()),
					new DateRange(Date::today(), Date::tomorrow()))),
			array(
				array(
					new DateRange(new Date('2014-07-16'), new Date('2014-07-26')),
					new DateRange(new Date('2014-07-15'), new Date('2014-07-20')))),
			array(
				array(
					new DateRange(new Date('2014-07-15'), new Date('2014-07-26')),
					new DateRange(new Date('2014-07-15'), new Date('2014-07-20')))),
		);
	}
}
