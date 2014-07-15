<?php

namespace Joomla\DateTime;

class Date
{
	/** @var DateTime */
	protected $datetime;

	public function __construct($date)
	{
		$datetime = $date instanceof DateTime ? $date : new DateTime($date);
		$this->datetime = $datetime->beginOfDay();
	}

	public static function createFromFormat($format, $date)
	{
		$obj = new Date(DateTime::createFromFormat($format, $date));
		return $obj;
	}

	public static function today()
	{
		return new Date(DateTime::today());
	}

	public static function tomorrow()
	{
		return new Date(DateTime::tomorrow());
	}

	public static function yesterday()
	{
		return new Date(DateTime::yesterday());
	}

	public function after(Date $date)
	{
		return $this->datetime > $date->datetime;
	}

	public function before(Date $date)
	{
		return $this->datetime < $date->datetime;
	}

	public function compareTo(Date $date)
	{
		if($this->after($date)) {
			return 1;
		}

		if($this->before($date)) {
			return -1;
		}

		return 0;
	}

	public function diff(Date $date, $absolute)
	{
		return $this->datetime->diff($date->datetime, $absolute);
	}

	public function equals(Date $datetime)
	{
		return $this->datetime == $datetime->datetime;
	}

	public function addDays($days)
	{
		return new Date($this->datetime->addDays($days));
	}

	public function subDays($days)
	{
		return new Date($this->datetime->subDays($days));
	}

	public function addWeeks($weeks)
	{
		return new Date($this->datetime->addWeeks($weeks));
	}

	public function subWeeks($weeks)
	{
		return new Date($this->datetime->subWeeks($weeks));
	}

	public function addMonths($months)
	{
		return new Date($this->datetime->addMonths($months));
	}

	public function subMonths($months)
	{
		return new Date($this->datetime->subMonths($months));
	}

	public function addYears($years)
	{
		return new Date($this->datetime->addYears($years));
	}

	public function subYears($years)
	{
		return new Date($this->datetime->subYears($years));
	}

	public function beginOfWeek()
	{
		return new Date($this->datetime->beginOfWeek());
	}

	public function endOfWeek()
	{
		return new Date($this->datetime->endOfWeek());
	}

	public function beginOfMonth()
	{
		return new Date($this->datetime->beginOfMonth());
	}

	public function endOfMonth()
	{
		return new Date($this->datetime->endOfMonth());
	}

	public function beginOfYear()
	{
		return new Date($this->datetime->beginOfYear());
	}

	public function endOfYear()
	{
		return new Date($this->datetime->endOfYear());
	}

	public function format($format)
	{
		return $this->datetime->format($format);
	}

	public static function setLocale($locale)
	{
		DateTime::setLocale($locale);
	}
}