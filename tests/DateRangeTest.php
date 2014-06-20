<?php

namespace Joomla\DateTime;

class DateRangeTest extends \PHPUnit_Framework_TestCase
{
	/** @var DateTime */
	private $start;

	/** @var DateTime */
	private $end;

	/** @var DateRange */
	private $SUT;

    protected function setUp()
    {
		$this->start = new DateTime('2014-06-12');
		$this->end = new DateTime('2014-07-13');
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
	public function it_should_determine_if_a_date_includes_into_a_range($includes, DateRange $sut, DateTime $date)
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
		$range = new DateRange(new DateTime('2014-06-12'), new DateTime('2014-07-13'));
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

	public function seedWithDatesAndRanges()
	{
		$start = new DateTime('2014-06-12 12:00:00');
		$end = new DateTime('2014-07-13 00:00:00');

		$range = new DateRange($start, $end);
		$adjustRange = new DateRange($start, $end, true);

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
		$sut = new DateRange(new DateTime('2014-06-10'), new DateTime('2014-06-20'));

		return array(
			array(false, $sut, new DateRange(new DateTime('2014-06-08'), new DateTime('2014-06-09'))), # start
			array(true,  $sut, new DateRange(new DateTime('2014-06-09'), new DateTime('2014-06-10'))), # start
			array(true,  $sut, new DateRange(new DateTime('2014-06-09'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new DateTime('2014-06-10'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new DateTime('2014-06-14'), new DateTime('2014-06-16'))), # middle
			array(true,  $sut, new DateRange(new DateTime('2014-06-19'), new DateTime('2014-06-20'))), # end
			array(true,  $sut, new DateRange(new DateTime('2014-06-19'), new DateTime('2014-06-21'))), # end
			array(true,  $sut, new DateRange(new DateTime('2014-06-20'), new DateTime('2014-06-21'))), # end
			array(false, $sut, new DateRange(new DateTime('2014-06-21'), new DateTime('2014-06-22'))), # end
			array(true,  $sut, new DateRange(new DateTime('2014-06-09'), new DateTime('2014-06-21'))), # whole
		);
	}

	public function seedWithIncludesRanges()
	{
		$sut = new DateRange(new DateTime('2014-06-10'), new DateTime('2014-06-20'));

		return array(
			array(false, $sut, new DateRange(new DateTime('2014-06-08'), new DateTime('2014-06-09'))), # start
			array(false, $sut, new DateRange(new DateTime('2014-06-09'), new DateTime('2014-06-10'))), # start
			array(false, $sut, new DateRange(new DateTime('2014-06-09'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new DateTime('2014-06-10'), new DateTime('2014-06-11'))), # start
			array(true,  $sut, new DateRange(new DateTime('2014-06-14'), new DateTime('2014-06-16'))), # middle
			array(true,  $sut, new DateRange(new DateTime('2014-06-19'), new DateTime('2014-06-20'))), # end
			array(false, $sut, new DateRange(new DateTime('2014-06-19'), new DateTime('2014-06-21'))), # end
			array(false, $sut, new DateRange(new DateTime('2014-06-20'), new DateTime('2014-06-21'))), # end
			array(false, $sut, new DateRange(new DateTime('2014-06-21'), new DateTime('2014-06-22'))), # end
			array(false, $sut, new DateRange(new DateTime('2014-06-09'), new DateTime('2014-06-21'))), # whole
		);
	}
}