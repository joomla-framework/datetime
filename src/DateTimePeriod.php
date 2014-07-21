<?php

namespace Joomla\DateTime;

class DateTimePeriod implements \Iterator
{
	/** @var DateTime */
	protected $start;

	/** @var DateTime */
	protected $end;

	/** @var \DateInterval */
	protected $interval;

	/** @var DateTime */
	protected $current;

	/** @var integer */
	protected $key;

	public function __construct(DateTime $start, DateTime $end, \DateInterval $interval)
	{
		$this->validate($start, $end, $interval);

		$this->start = $start;
		$this->end = $end;
		$this->interval = $interval;

		$this->current = $this->start;
		$this->key = 0;
	}

	public static function from(DateTime $start, $amount, \DateInterval $interval)
	{
		$end = self::buildDatetime($start, $amount, $interval, true);
		return new DateTimePeriod($start, $end, $interval);
	}

	public static function to(DateTime $end, $amount, \DateInterval $interval)
	{
		$start = self::buildDatetime($end, $amount, $interval, false);
		return new DateTimePeriod($start, $end, $interval);
	}

	public function current()
	{
		return $this->current;
	}

	public function key()
	{
		return $this->key;
	}

	public function next()
	{
		$this->key++;
		$this->current = $this->current->add($this->interval);
		return $this->valid();
	}

	public function rewind()
	{
		$this->key = 0;
		$this->current = $this->start;
	}

	public function valid()
	{
		return !$this->current->isAfter($this->end);
	}

	public function toArray()
	{
		$period = array();
		foreach($this as $datetime) {
			$period[] = $datetime;
		}

		return $period;
	}

	private function validate(DateTime $start, DateTime $end, \DateInterval $interval)
	{
		if(!$start->isBefore($end)) {
			throw new \InvalidArgumentException("Start object have to be before the end object");
		}

		if($start->add($interval)->isAfter($end)) {
			throw new \InvalidArgumentException("Interval is too big");
		}
	}

	private static function buildDatetime(DateTime $base, $amount, \DateInterval $interval, $byAddition = true)
	{
		if(intval($amount) < 2) {
			throw new \InvalidArgumentException('Amount have to be greater than 2');
		}

		/** Start from 2, because start date and end date also count */
		for($i = 2; $i <= $amount; $i++) {
			$base = $byAddition ? $base->add($interval) : $base->sub($interval);
		}

		return $base;
	}
}
