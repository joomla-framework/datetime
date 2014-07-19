<?php

namespace Joomla\DateTime;

class DateRangeTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateAnEmptyRange()
    {
		$range = DateRange::emptyRange();
		$this->assertTrue($range->isEmpty());
    }

	public function testCanDetermineIfARangeIsEmpty()
    {
		$range = new DateRange(new Date('2014-07-13'), new Date('2014-06-12'));
		$this->assertTrue($range->isEmpty());
    }

	public function testCanDetermineIfTwoRangesAreEqual()
	{
		$range = new DateRange(new Date('2014-06-12'), new Date('2014-07-13'));

		$this->assertTrue($range->equals(new DateRange(new Date('2014-06-12'), new Date('2014-07-13'))));
		$this->assertFalse($range->equals(new DateRange(new Date('2014-06-12'), new Date('2014-07-12'))));
	}

	/**
	 * @dataProvider seedForIncludesADate
	 */
	public function testCanDetermineIfADateIncludesIntoARange($includes, DateRange $sut, Date $date)
	{
		if($includes) {
			$this->assertTrue($sut->includes($date));
		} else {
			$this->assertFalse($sut->includes($date));
		}
	}

	/**
	 * @dataProvider seedForOverlaps
	 */
	public function testCanDetermineIfOneRangeOverlapsWithAnotherOne($overlaps, DateRange $sut, DateRange $range)
	{
		if($overlaps) {
			$this->assertTrue($sut->overlaps($range));
		} else {
			$this->assertFalse($sut->overlaps($range));
		}
	}

	/**
	 * @dataProvider seedForIncludesARange
	 */
	public function testCanDetermineIfOneRangeIncludesAnotherOne($includes, DateRange $sut, DateRange $range)
	{
		if($includes) {
			$this->assertTrue($sut->includesRange($range));
		} else {
			$this->assertFalse($sut->includesRange($range));
		}
	}

	/**
	 * @dataProvider seedForGap
	 */
	public function testCanCreateAGapRangeBetweenTwoRanges(DateRange $sut, DateRange $range, DateRange $gap)
	{
		$this->assertEquals($gap, $sut->gap($range));
	}

	/**
	 * @dataProvider seedForAbuts
	 */
	public function testCanDetermineIfTwoRangesAbutWithEachOther($abuts, DateRange $sut, DateRange $range)
	{
		if($abuts) {
			$this->assertTrue($sut->abuts($range));
		} else {
			$this->assertFalse($sut->abuts($range));
		}
	}

	/**
	 * @dataProvider seedWithContiguousRanges
	 */
	public function testCanDetermineIfRangesAreContiguous($contiguous, array $ranges)
	{
		if($contiguous) {
			$this->assertTrue(DateRange::isContiguous($ranges));
		} else {
			$this->assertFalse(DateRange::isContiguous($ranges));
		}
	}

	/**
	 * @dataProvider seedWithCombinationRanges
	 */
	public function testCanCombinateManyContiguousRangesIntoOne(DateRange $result, array $ranges)
	{
		$this->assertEquals($result, DateRange::combination($ranges));
	}

	public function testCanReturnAnArrayOfDatesIncludedInGivenRange()
	{
		$range = new DateRange(new Date('2014-06-29'), new Date('2014-07-04'));

		$this->assertEquals(array(
				new Date('2014-06-29'),new Date('2014-06-30'),new Date('2014-07-01'),
				new Date('2014-07-02'),new Date('2014-07-03'),new Date('2014-07-04'),
			), $range->toArray()
		);
	}

	public function seedForIncludesADate()
	{
		$start = new Date('2014-06-12');
		$end = new Date('2014-07-13');

		$range = new DateRange($start, $end);

		return array(
			array(true,  $range, $start),
			array(true,  $range, new Date('2014-06-28')),
			array(true,  $range, $end),
			array(false, $range, $start->subDays(1)),
			array(false, $range, $end->addDays(1))
		);
	}

	public function seedForOverlaps()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-20'));

		return array(
			array(false, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))), # start
			array(true,  $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-10'))), # start
			array(true,  $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new Date('2014-06-10'), new Date('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new Date('2014-06-14'), new Date('2014-06-16'))), # middle
			array(true,  $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-20'))), # end
			array(true,  $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-21'))), # end
			array(true,  $sut, new DateRange(new Date('2014-06-20'), new Date('2014-06-21'))), # end
			array(false, $sut, new DateRange(new Date('2014-06-21'), new Date('2014-06-22'))), # end
			array(true,  $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-21'))), # whole
		);
	}

	public function seedForIncludesARange()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-20'));

		return array(
			array(false, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))), # start
			array(false, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-10'))), # start
			array(false, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new Date('2014-06-10'), new Date('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new Date('2014-06-14'), new Date('2014-06-16'))), # middle
			array(true,  $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-20'))), # end
			array(false, $sut, new DateRange(new Date('2014-06-19'), new Date('2014-06-21'))), # end
			array(false, $sut, new DateRange(new Date('2014-06-20'), new Date('2014-06-21'))), # end
			array(false, $sut, new DateRange(new Date('2014-06-21'), new Date('2014-06-22'))), # end
			array(false, $sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-21'))), # whole
		);
	}

	public function seedWithRangesWithoutGap()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-13'));

		return array(
			array($sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-10'))),
			array($sut, new DateRange(new Date('2014-06-10'), new Date('2014-06-11'))),
			array($sut, new DateRange(new Date('2014-06-10'), new Date('2014-06-13'))),
			array($sut, new DateRange(new Date('2014-06-10'), new Date('2014-06-14'))),
			array($sut, new DateRange(new Date('2014-06-11'), new Date('2014-06-12'))),
			array($sut, new DateRange(new Date('2014-06-12'), new Date('2014-06-13'))),
			array($sut, new DateRange(new Date('2014-06-12'), new Date('2014-06-14'))),
			array($sut, new DateRange(new Date('2014-06-13'), new Date('2014-06-14'))),
			array($sut, new DateRange(new Date('2014-06-09'), new Date('2014-06-14'))),
		);
	}

	public function seedForGap()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-13'));

		return array(
			array($sut, new DateRange(new Date('2014-06-07'), new Date('2014-06-08')),
						new DateRange(new Date('2014-06-09'), new Date('2014-06-09'))),
			array($sut, new DateRange(new Date('2014-06-16'), new Date('2014-06-17')),
						new DateRange(new Date('2014-06-14'), new Date('2014-06-15')))
		);
	}

	public function seedForAbuts()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-13'), true);

		return array(
			array(false, $sut, new DateRange(new Date('2014-06-13'), new Date('2014-06-15'))),
			array(true,  $sut, new DateRange(new Date('2014-06-14'), new Date('2014-06-15'))),
			array(false, $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-10'))),
			array(true,  $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))),
			array(true,  $sut, new DateRange(new Date('2014-06-08'), new Date('2014-06-09'))),
		);
	}

	public function seedWithContiguousRanges()
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

	public function seedWithCombinationRanges()
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
}