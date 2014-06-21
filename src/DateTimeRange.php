<?php

namespace Joomla\DateTime;


/**
 * @todo parametr for precision? date, hour, minute, second?
 * @todo Composite pattern?
 */
final class DateTimeRange
{
	/** @var DateTime */
	private $start;

	/** @var DateTime */
	private $end;

	public function __construct(DateTime $start, DateTime $end, $adjustTime = false)
	{
		if($adjustTime) {
			$start = $start->beginOfDay();
			$end = $end->endOfDay();
		}

		$this->start = self::trimToMinutes($start);
		$this->end   = self::trimToMinutes($end);
	}

	public static function emptyRange()
	{
		return new DateTimeRange(DateTime::tomorrow(), DateTime::yesterday());
	}

	/** @return DateTime */
	public function start()
	{
		return $this->start;
	}

	/** @return DateTime */
	public function end()
	{
		return $this->end;
	}

	public function isEmpty()
	{
		return $this->start->after($this->end);
	}

	public function includes(DateTime $date)
	{
		return !$date->before($this->start) && !$date->after($this->end);
	}

	public function equals(DateTimeRange $range)
	{
		return $this->start->equals($range->start) && $this->end->equals($range->end);
	}

	public function overlaps(DateTimeRange $range)
	{
		return $range->includes($this->start) || $range->includes($this->end) || $this->includesRange($range);
	}

	public function includesRange(DateTimeRange $range)
	{
		return $this->includes($range->start) && $this->includes($range->end);
	}

	public function compareTo(DateTimeRange $range)
	{
		if(!$this->start->equals($range->start)) {
			return $this->start->compareTo($range->start);
		}

		return $this->end->compareTo($range->end);
	}

	/** @return DateTimeRange */
	public function gap(DateTimeRange $range)
	{
		if($this->overlaps($range)) return self::emptyRange();

		$lower = $higher = null;
		if($this->compareTo($range) < 0) {
			$lower = $this;
			$higher = $range;
		} else {
			$lower = $range;
			$higher = $this;
		}

		return new DateTimeRange($lower->end->addMinutes(1), $higher->start->subMinutes(1));
	}

	public function abuts(DateTimeRange $range)
	{
		return !$this->overlaps($range) && $this->gap($range)->isEmpty();
	}

	/**
	 * @todo tests
	 *
	 * @param DateTimeRange[] $ranges
	 * @return boolean
	 */
	public function partitionedBy(array $ranges)
	{
		if(!self::isContiguous($ranges)) return false;
		return $this->equals(self::combination($ranges));
	}

	/**
	 * @todo tests
	 *
	 * @param DateTimeRange[] $ranges
	 * @return DateTimeRange
	 */
	public static function combination(array $ranges)
	{
		$ranges = self::sortArrayOfRanges($ranges);
		if(!self::isContiguous($ranges)) throw new \InvalidArgumentException('Unable to combine date ranges');
		return new DateTimeRange($ranges[0]->start, $ranges[count($ranges)-1]->end);
	}

	/**
	 * @todo tests
	 *
	 * @param DateTimeRange[] $ranges
	 * @return boolean
	 */
	public static function isContiguous(array $ranges)
	{
		$ranges = self::sortArrayOfRanges($ranges);
		for($i = 0; $i < count($ranges) - 1; $i++) {
			if(!$ranges[$i]->abuts($ranges[$i+1])) {
				return false;
			}
		}
		return true;
	}

	/**
	 * @param DateTimeRange[] $ranges
	 * @return DateTimeRange[]
	 */
	private static function sortArrayOfRanges(array $ranges)
	{
		return array_values(usort($ranges, function(DateTimeRange $a, DateTimeRange $b) {
			return $a->compareTo($b);
		}));
	}

	private static function trimToMinutes(DateTime $datetime)
	{
		return $datetime->subSeconds($datetime->format('s'));
	}
}