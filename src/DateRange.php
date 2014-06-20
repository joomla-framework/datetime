<?php

namespace Joomla\DateTime;


/**
 * @todo parametr for precision? date, hour, minute, second?
 * @todo Composite pattern?
 */
final class DateRange
{
	/** @var DateTime */
	private $start;

	/** @var DateTime */
	private $end;

	public function __construct(DateTime $start, DateTime $end, $adjustTime = false)
	{
		if($adjustTime) {
			$this->start = $start->beginOfDay();
			$this->end = $end->endOfDay();
		} else {
			$this->start = $start;
			$this->end = $end;
		}
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

	public function equals(DateRange $range)
	{
		return $this == $range;
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
		if($this->overlaps($range)) return null;

		$lower = $higher = null;
		if($this->compareTo($range) < 0) {
			$lower = $this;
			$higher = $range;
		} else {
			$lower = $range;
			$higher = $this;
		}

		return new DateRange($lower->end->addSeconds(1), $higher->start->subSeconds(1));
	}

	public function abuts()
	{

	}

	public function partitionedBy()
	{

	}

	public static function combination()
	{

	}

	public static function isContiguous()
	{

	}
}
