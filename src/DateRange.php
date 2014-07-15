<?php

namespace Joomla\DateTime;

final class DateRange
{
	/** @var Date */
	private $start;

	/** @var Date */
	private $end;

	public function __construct(Date $start, Date $end)
	{
		// @todo jak DateTime bedzie dziedzyc po Date to bedzie mozna tutaj miec dateTime! - trzeba zrobic trim na
		// lub stworz nowy Date na podsatwie DateTime i w konstkrutorze date martw sie by trimowac!

		$this->start = $start;
		$this->end   = $end;
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
		return $this->start->after($this->end);
	}

	public function includes(Date $date)
	{
		return !$date->before($this->start) && !$date->after($this->end);
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

	public function compareTo(DateRange $range)
	{
		if(!$this->start->equals($range->start)) {
			return $this->start->compareTo($range->start);
		}

		return $this->end->compareTo($range->end);
	}

	/** @return DateRange */
	public function gap(DateRange $range)
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

		return new DateRange($lower->end->addDays(1), $higher->start->subDays(1));
	}

	public function abuts(DateRange $range)
	{
		return !$this->overlaps($range) && $this->gap($range)->isEmpty();
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
			return $a->compareTo($b);
		});
		return array_values($ranges);
	}


}