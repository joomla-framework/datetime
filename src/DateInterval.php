<?php

namespace Joomla\DateTime;

/**
 * DateInterval.
 *
 * @property-read  integer   $y        Number of years.
 * @property-read  integer   $m        Number of months.
 * @property-read  integer   $d        Number of days.
 * @property-read  integer   $h        Number of hours.
 * @property-read  integer   $i        Number of minutes.
 * @property-read  integer   $s        Number of seconds.
 * @property-read  integer   $invert   Is 1 if the interval represents a negative time period and 0 otherwise.
 * @property-read  mixed     $days     If the DateInterval object was created by DateTime::diff(), then this is the total number
 *                                       of days between the start and end dates. Otherwise, days will be FALSE.
 * @since  2.0
 */
final class DateInterval
{
	/** @var \DateInterval */
	private $interval;

	public function __construct($interval)
	{
		if ($interval instanceof \DateInterval)
		{
			$this->interval = $this->copy($interval);
		}
		else
		{
			$this->interval = new \DateInterval($interval);
		}
	}

	public static function createFromDateString($time)
	{
		return new DateInterval(\DateInterval::createFromDateString($time));
	}

	public function format($format)
	{
		return $this->interval->format($format);
	}

	public function __get($name)
	{
		return $this->interval->$name;
	}

	private static function copy(\DateInterval $interval)
	{
		return new \DateInterval($interval->format('P%yY%mM%dDT%hH%iM%sS'));
	}
}
