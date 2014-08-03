<?php

namespace Joomla\DateTime;

/**
 * DateInterval.
 *
 * @property-read  integer   $y        t - Number of days in the given month.
 * @property-read  integer   $m        t - Number of days in the given month.
 * @property-read  integer   $d        t - Number of days in the given month.
 * @property-read  integer   $h        t - Number of days in the given month.
 * @property-read  integer   $i        t - Number of days in the given month.
 * @property-read  integer   $s        t - Number of days in the given month.
 * @property-read  integer   $invert   t - Number of days in the given month.
 * @property-read  mixed     $days     t - Number of days in the given month.
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
