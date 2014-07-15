<?php

namespace Joomla\DateTime;

class DateRangeTest extends \PHPUnit_Framework_TestCase
{
	/** @var Date */
	private $start;

	/** @var Date */
	private $end;

	/** @var DateRange */
	private $SUT;

    protected function setUp()
    {
		$this->start = new Date('2014-06-12');
		$this->end = new Date('2014-07-13');
		$this->SUT = new DateRange($this->start, $this->end);
    }

    /** @test */
    public function it_should_check_that_range_is_empty()
    {
		$range = new DateRange($this->end, $this->start);
		$this->assertTrue($range->isEmpty());
    }

	/**
	 * @test
	 * @dataProvider seedWithDatesAndRanges
	 */
	public function it_should_determine_if_a_date_includes_into_a_range($includes, DateRange $sut, Date $date)
	{
		if($includes) {
			$this->assertTrue($sut->includes($date));
		} else {
			$this->assertFalse($sut->includes($date));
		}
	}

	/** @test */
	public function it_should_determine_if_two_objects_are_equal()
	{
		$range = new DateRange(new Date('2014-06-12'), new Date('2014-07-13'));
		$this->assertTrue($this->SUT->equals($range));
	}

	/**
	 * @test
	 * @dataProvider seedWithOverlapsRanges
	 */
	public function it_should_determine_if_one_range_overlaps_with_another_one($overlaps, DateRange $sut, DateRange $range)
	{
		if($overlaps) {
			$this->assertTrue($sut->overlaps($range));
		} else {
			$this->assertFalse($sut->overlaps($range));
		}
	}

	/**
	 * @test
	 * @dataProvider seedWithIncludesRanges
	 */
	public function it_should_determine_if_one_range_includes_another_one($includes, DateRange $sut, DateRange $range)
	{
		if($includes) {
			$this->assertTrue($sut->includesRange($range));
		} else {
			$this->assertFalse($sut->includesRange($range));
		}
	}

	/**
	 * @test
	 * @dataProvider seedWithRangesWithoutGap
	 */
	public function it_should_create_an_empty_gap_range_between_two_ranges(DateRange $sut, DateRange $range)
	{
		$this->assertTrue($sut->gap($range)->isEmpty());
	}

	/**
	 * @test
	 * @dataProvider seedWithGapRanges
	 */
	public function it_should_create_a_gap_range_between_two_ranges(DateRange $sut, DateRange $range, DateRange $gap)
	{
		$this->assertTrue($gap->equals($sut->gap($range)));
	}

	/**
	 * @test
	 * @dataProvider seedWithAbutRanges
	 */
	public function it_should_determine_if_two_ranges_abut_with_each_other($abuts, DateRange $sut, DateRange $range)
	{
		if($abuts) {
			$this->assertTrue($sut->abuts($range));
		} else {
			$this->assertFalse($sut->abuts($range));
		}
	}

	/**
	 * @test
	 * @dataProvider seedWithContiguousRanges
	 */
	public function it_should_determine_if_ranges_are_contiguous($contiguous, array $ranges)
	{
		if($contiguous) {
			$this->assertTrue(DateRange::isContiguous($ranges));
		} else {
			$this->assertFalse(DateRange::isContiguous($ranges));
		}
	}

	/**
	 * @test
	 * @dataProvider seedWithCombinationRanges
	 */
	public function it_should_combinate_ranges_into_one(DateRange $result, array $ranges)
	{
		$this->assertTrue($result->equals(DateRange::combination($ranges)));
	}

	public function seedWithDatesAndRanges()
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

	public function seedWithOverlapsRanges()
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

	public function seedWithIncludesRanges()
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

	public function seedWithGapRanges()
	{
		$sut = new DateRange(new Date('2014-06-10'), new Date('2014-06-13'));

		return array(
			array($sut, new DateRange(new Date('2014-06-07'), new Date('2014-06-08')),
						new DateRange(new Date('2014-06-09'), new Date('2014-06-09'))),
			array($sut, new DateRange(new Date('2014-06-16'), new Date('2014-06-17')),
						new DateRange(new Date('2014-06-14'), new Date('2014-06-15')))
		);
	}

	public function seedWithAbutRanges()
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
				new DateRange(new Date('2014-06-13'), new Date('2014-06-16')),
				new DateRange(new Date('2014-06-16'), new Date('2014-06-18'))
			)),
			array(false, array(
				new DateRange(new Date('2014-06-10'), new Date('2014-06-12')),
				new DateRange(new Date('2014-06-12'), new Date('2014-06-15')),
				new DateRange(new Date('2014-06-16'), new Date('2014-06-18'))
			)),
		);
	}

	public function seedWithCombinationRanges()
	{
		return array(
			array(
				new DateRange(new Date('2014-06-12'), new Date('2014-06-18')),
				array(
					new DateRange(new Date('2014-06-12'), new Date('2014-06-12')),
					new DateRange(new Date('2014-06-13'), new Date('2014-06-15')),
					new DateRange(new Date('2014-06-16'), new Date('2014-06-18'))
				)
			),
			array(
				new DateRange(new Date('2014-06-10'), new Date('2014-06-18')),
				array(
					new DateRange(new Date('2014-06-10'), new Date('2014-06-12')),
					new DateRange(new Date('2014-06-12'), new Date('2014-06-15')),
					new DateRange(new Date('2014-06-15'), new Date('2014-06-18'))
				)
			),
		);
	}
}