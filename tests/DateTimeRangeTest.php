<?php

namespace Joomla\DateTime;

class DateTimeRangeTest extends \PHPUnit_Framework_TestCase
{
	/** @var DateTime */
	private $start;

	/** @var DateTime */
	private $end;

	/** @var DateTimeRange */
	private $SUT;

    protected function setUp()
    {
		$this->start = new DateTime('2014-06-12');
		$this->end = new DateTime('2014-07-13');
		$this->SUT = new DateTimeRange($this->start, $this->end);
    }

    /** @test */
    public function it_should_check_that_range_is_empty()
    {
		$range = new DateTimeRange($this->end, $this->start);
		$this->assertTrue($range->isEmpty());
    }

	/**
	 * @test
	 * @dataProvider seedWithDatesAndRanges
	 */
	public function it_should_determine_if_a_date_includes_into_a_range($includes, DateTimeRange $sut, DateTime $date)
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
		$range = new DateTimeRange(new DateTime('2014-06-12'), new DateTime('2014-07-13'));
		$this->assertTrue($this->SUT->equals($range));
	}

	/**
	 * @test
	 * @dataProvider seedWithOverlapsRanges
	 */
	public function it_should_determine_if_one_range_overlaps_with_another_one($overlaps, DateTimeRange $sut, DateTimeRange $range)
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
	public function it_should_determine_if_one_range_includes_another_one($includes, DateTimeRange $sut, DateTimeRange $range)
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
	public function it_should_create_an_empty_gap_range_between_two_ranges(DateTimeRange $sut, DateTimeRange $range)
	{
		$this->assertTrue($sut->gap($range)->isEmpty());
	}

	/**
	 * @test
	 * @dataProvider seedWithGapRanges
	 */
	public function it_should_create_a_gap_range_between_two_ranges(DateTimeRange $sut, DateTimeRange $range, DateTimeRange $gap)
	{
		$this->assertTrue($gap->equals($sut->gap($range)));
	}

	/**
	 * @test
	 * @dataProvider seedWithAbutRanges
	 */
	public function it_should_determine_if_two_ranges_abut_with_each_other($abuts, DateTimeRange $sut, DateTimeRange $range)
	{
		if($abuts) {
			$this->assertTrue($sut->abuts($range));
		} else {
			$this->assertFalse($sut->abuts($range));
		}
	}

	public function seedWithDatesAndRanges()
	{
		$start = new DateTime('2014-06-12 12:00:00');
		$end = new DateTime('2014-07-13 00:00:00');

		$range = new DateTimeRange($start, $end);
		$adjustRange = new DateTimeRange($start, $end, true);

		return array(
			array(true,  $range, $start),
			array(true,  $range, new DateTime('2014-06-28')),
			array(true,  $range, $end),
			array(false, $range, $start->subDays(1)),
			array(false, $range, $end->addDays(1)),
			array(false, $range, new DateTime('2014-06-12 11:00:00')),
			array(false, $range, new DateTime('2014-07-13 11:00:00')),
			array(true,  $adjustRange, new DateTime('2014-06-12 11:00:00')),
			array(true,  $adjustRange, new DateTime('2014-07-13 11:00:00'))
		);
	}

	public function seedWithOverlapsRanges()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-20'));
		$sutTime = new DateTimeRange(new DateTime('2014-07-01 10:00'), new DateTime('2014-07-01 20:00'));

		return array(
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-08'), new DateTime('2014-06-09'))), # start
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-10'))), # start
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-14'), new DateTime('2014-06-16'))), # middle
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-19'), new DateTime('2014-06-20'))), # end
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-19'), new DateTime('2014-06-21'))), # end
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-20'), new DateTime('2014-06-21'))), # end
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-21'), new DateTime('2014-06-22'))), # end
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-21'))), # whole
			// for time precision
			array(false, $sutTime, new DateTimeRange(new DateTime('2014-07-01 08:00'), new DateTime('2014-07-01 09:00'))), # start
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 09:00'), new DateTime('2014-07-01 10:00'))), # start
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 09:00'), new DateTime('2014-07-01 11:00'))), # start
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 10:00'), new DateTime('2014-07-01 11:00'))), # start
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 14:00'), new DateTime('2014-07-01 16:00'))), # middle
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 19:00'), new DateTime('2014-07-01 20:00'))), # end
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 19:00'), new DateTime('2014-07-01 21:00'))), # end
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 20:00'), new DateTime('2014-07-01 21:00'))), # end
			array(false, $sutTime, new DateTimeRange(new DateTime('2014-07-01 21:00'), new DateTime('2014-07-01 22:00'))), # end
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-07-01 09:00'), new DateTime('2014-07-01 21:00'))), # whole
		);
	}

	public function seedWithIncludesRanges()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-20'));

		return array(
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-08'), new DateTime('2014-06-09'))), # start
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-10'))), # start
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-14'), new DateTime('2014-06-16'))), # middle
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-19'), new DateTime('2014-06-20'))), # end
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-19'), new DateTime('2014-06-21'))), # end
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-20'), new DateTime('2014-06-21'))), # end
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-21'), new DateTime('2014-06-22'))), # end
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-21'))), # whole
		);
	}

	public function seedWithRangesWithoutGap()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-13'));
		$sutTime = new DateTimeRange(new DateTime('2014-07-01 10:00'), new DateTime('2014-07-01 13:00'));

		return array(
			array($sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-10'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-11'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-13'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-14'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-11'), new DateTime('2014-06-12'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-12'), new DateTime('2014-06-13'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-12'), new DateTime('2014-06-14'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-13'), new DateTime('2014-06-14'))),
			array($sut, new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-14'))),
			// for time precision
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 09:00'), new DateTime('2014-07-01 10:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 10:00'), new DateTime('2014-07-01 11:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 10:00'), new DateTime('2014-07-01 13:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 10:00'), new DateTime('2014-07-01 14:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 11:00'), new DateTime('2014-07-01 12:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 12:00'), new DateTime('2014-07-01 13:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 12:00'), new DateTime('2014-07-01 14:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 13:00'), new DateTime('2014-07-01 14:00'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-07-01 09:00'), new DateTime('2014-07-01 14:00')))

		);
	}

	public function seedWithGapRanges()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-13'), true);
		$sutTime = new DateTimeRange(new DateTime('2014-06-10 14:00'), new DateTime('2014-06-13 12:00'));

		return array(
			array($sut, new DateTimeRange(new DateTime('2014-06-07'), new DateTime('2014-06-08'), true),
						new DateTimeRange(new DateTime('2014-06-09'), new DateTime('2014-06-09'), true)),
			array($sut, new DateTimeRange(new DateTime('2014-06-16'), new DateTime('2014-06-17'), true),
						new DateTimeRange(new DateTime('2014-06-14'), new DateTime('2014-06-15'), true)),
			array($sutTime, new DateTimeRange(new DateTime('2014-06-07 14:00'), new DateTime('2014-06-08 12:00')),
							new DateTimeRange(new DateTime('2014-06-08 12:01'), new DateTime('2014-06-10 13:59'))),
			array($sutTime, new DateTimeRange(new DateTime('2014-06-15 14:00'), new DateTime('2014-06-16 12:00')),
							new DateTimeRange(new DateTime('2014-06-13 12:01'), new DateTime('2014-06-15 13:59'))),
		);
	}

	public function seedWithAbutRanges()
	{
		$sut = new DateTimeRange(new DateTime('2014-06-10'), new DateTime('2014-06-13'), true);
		$sutTime = new DateTimeRange(new DateTime('2014-06-10 14:00'), new DateTime('2014-06-13 12:00'));

		return array(
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-13 23:59'), new DateTime('2014-06-15'))),
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-14'), new DateTime('2014-06-15'))),
			array(false, $sut, new DateTimeRange(new DateTime('2014-06-08'), new DateTime('2014-06-10'))),
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-08'), new DateTime('2014-06-09 23:59'))),
			array(true,  $sut, new DateTimeRange(new DateTime('2014-06-08'), new DateTime('2014-06-09'), true)),
			array(false, $sutTime, new DateTimeRange(new DateTime('2014-06-13 12:00'), new DateTime('2014-06-15'))),
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-06-13 12:01'), new DateTime('2014-06-15'))),
			array(false, $sutTime, new DateTimeRange(new DateTime('2014-06-08'), new DateTime('2014-06-10 14:00'))),
			array(true,  $sutTime, new DateTimeRange(new DateTime('2014-06-08'), new DateTime('2014-06-10 13:59'))),
		);
	}
}