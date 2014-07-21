<?php

namespace Joomla\DateTime;

final class DateRange implements \Iterator
{
	/** @var Date */
	private $start;

	/** @var Date */
	private $end;

	/** @var integer */
	private $position;

	public function __construct(Date $start, Date $end)
	{
		$this->position	= 0;
		$this->start	= $start;
		$this->end		= $end;
	}

	public static function emptyRange()
	{
		return new DateRange(Date::tomorrow(), Date::yesterday());
	}

	/** @return Date */
	public function start()
	{
		return $this->start;
	}

	/** @return Date */
	public function end()
	{
		return $this->end;
	}

	public function isEmpty()
	{
		return $this->start->isAfter($this->end);
	}

	public function includes(Date $date)
	{
		return !$date->isBefore($this->start) && !$date->isAfter($this->end);
	}

	public function equals(DateRange $range)
	{
		return $this->start->equals($range->start) && $this->end->equals($range->end);
	}

	public function overlaps(DateRange $range)
	{
		return $range->includes($this->start) || $range->includes($this->end) || $this->includesRange($range);
	}

	public function includesRange(DateRange $range)
	{
		return $this->includes($range->start) && $this->includes($range->end);
	}

	/** @return DateRange */
	public function gap(DateRange $range)
	{
		if($this->overlaps($range)) return self::emptyRange();

		$lower = $higher = null;
		if($this->start->isBefore($range->start)) {
			$lower = $this;
			$higher = $range;
		} else {
			$lower = $range;
			$higher = $this;
		}

		return new DateRange($lower->end->addDays(1), $higher->start->subDays(1));
	}

	public function abuts(DateRange $range)
	{
		return !$this->overlaps($range) && $this->gap($range)->isEmpty();
	}

	public function toArray()
	{
		$range = array();
		foreach($this as $day) {
			$range[] = $day;
		}

		return $range;
	}

	public function __toString()
	{
		return sprintf('%s - %s', $this->start->format('Y-m-d'), $this->end->format('Y-m-d'));
	}

	public function current()
	{
		return $this->start->addDays($this->position);
	}

	public function key()
	{
		return $this->position;
	}

	public function next()
	{
		$this->position++;
		return $this->valid();
	}

	public function rewind()
	{
		$this->position = 0;
	}

	public function valid()
	{
		return $this->position <= $this->end->diff($this->start)->format('%d');
	}

	/**
	 * @param DateRange[] $ranges
	 * @return DateRange
	 */
	public static function combination(array $ranges)
	{
		$ranges = self::sortArrayOfRanges($ranges);
		if(!self::isContiguous($ranges)) throw new \InvalidArgumentException('Unable to combine date ranges');
		return new DateRange($ranges[0]->start, $ranges[count($ranges)-1]->end);
	}

	/**
	 * @param DateRange[] $ranges
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
	 * @param DateRange[] $ranges
	 * @return DateRange[]
	 */
	private static function sortArrayOfRanges(array $ranges)
	{
		usort($ranges, function(DateRange $a, DateRange $b) {
			if($a->equals($b)) return 0;

			if($a->start->isAfter($b->start)) return 1;
			if($a->start->isBefore($b->start) || $a->end->isBefore($b->end)) return -1;

			return 1;
		});

		return array_values($ranges);
	}
}