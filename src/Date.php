<?php

namespace Joomla\DateTime;

final class Date
{
	/** @var DateTime */
	protected $datetime;

	public function __construct($date)
	{
		if(!$date instanceof DateTime) {
			$date = new DateTime($date);
		}

		$this->datetime = $date->startOfDay();
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

	public function isAfter(Date $date)
	{
		return $this->datetime->isAfter($date->datetime);
	}

	public function isBefore(Date $date)
	{
		return $this->datetime->isBefore($date->datetime);
	}

	public function equals(Date $date)
	{
		return $this->datetime->equals($date->datetime);
	}

	public function diff(Date $date, $absolute = false)
	{
		return $this->datetime->diff($date->datetime, $absolute);
	}

	public function addDays($value)
	{
		return new Date($this->datetime->addDays($value));
	}

	public function subDays($value)
	{
		return new Date($this->datetime->subDays($value));
	}

	public function addWeeks($value)
	{
		return new Date($this->datetime->addWeeks($value));
	}

	public function subWeeks($value)
	{
		return new Date($this->datetime->subWeeks($value));
	}

	public function addMonths($value)
	{
		return new Date($this->datetime->addMonths($value));
	}

	public function subMonths($value)
	{
		return new Date($this->datetime->subMonths($value));
	}

	public function addYears($value)
	{
		return new Date($this->datetime->addYears($value));
	}

	public function subYears($value)
	{
		return new Date($this->datetime->subYears($value));
	}

	public function startOfWeek()
	{
		return new Date($this->datetime->startOfWeek());
	}

	public function endOfWeek()
	{
		return new Date($this->datetime->endOfWeek());
	}

	public function startOfMonth()
	{
		return new Date($this->datetime->startOfMonth());
	}

	public function endOfMonth()
	{
		return new Date($this->datetime->endOfMonth());
	}

	public function startOfYear()
	{
		return new Date($this->datetime->startOfYear());
	}

	public function endOfYear()
	{
		return new Date($this->datetime->endOfYear());
	}

	public function format($format)
	{
		return $this->datetime->format($format);
	}

	public function timeSince(DateTime $datetime = null, $detailLevel = 1, $allowAlmost = false)
	{
		$this->datetime->timeSince($datetime, $detailLevel, $allowAlmost);
	}

	public function almostTimeSince(DateTime $datetime = null, $detailLevel = 1)
	{
		$this->datetime->almostTimeSince($datetime, $detailLevel);
	}

	/** @return \DateTime */
	public function getDateTime()
	{
		return $this->datetime->getDateTime();
	}

	public static function setTranslator(DateTimeTranslator $translator)
	{
		DateTime::setTranslator($translator);
	}

	public static function setLocale($locale)
	{
		DateTime::setLocale($locale);
	}
}