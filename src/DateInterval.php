<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

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
 * @since  2.0
 */
final class DateInterval
{
	/** @var \DateInterval */
	private $interval;

	/**
	 * Constructor.
	 *
	 * @param   mixed  $interval  Might be a PHP DateInterval object or a string with an interval specification.
	 */
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

	/**
	 * Creates a DateInterval object from the relative parts of the string.
	 *
	 * @param   string  $time  A date with relative parts.
	 *
	 * @return DateInterval
	 */
	public static function createFromDateString($time)
	{
		return new DateInterval(\DateInterval::createFromDateString($time));
	}

	/**
	 * Creates a DateInterval object by adding another interval into it.
	 * Uses absolute values for addition process.
	 *
	 * @param   DateInterval  $interval  The interval to be added.
	 *
	 * @return DateInterval
	 */
	public function add(DateInterval $interval)
	{
		$years   = $this->y + $interval->y;
		$months  = $this->m + $interval->m;
		$days    = $this->d + $interval->d;
		$hours   = $this->h + $interval->h;
		$minutes = $this->i + $interval->i;
		$seconds = $this->s + $interval->s;

		$spec = sprintf('P%sY%sM%sDT%sH%sM%sS', $years, $months, $days, $hours, $minutes, $seconds);

		return new DateInterval($spec);
	}

	/**
	 * Checks if the current interval is equals to the interval given as parameter.
	 *
	 * @param   DateInterval  $interval  The interval to compare.
	 *
	 * @return boolean
	 */
	public function equals(DateInterval $interval)
	{
		$years   = $this->y == $interval->y;
		$months  = $this->m == $interval->m;
		$days    = $this->d == $interval->d;
		$hours   = $this->h == $interval->h;
		$minutes = $this->i == $interval->i;
		$seconds = $this->s == $interval->s;
		$invert  = $this->invert == $interval->invert;

		return $years && $months && $days && $hours && $minutes && $seconds && $invert;
	}

	/**
	 * Creates a DateInterval object by inverting the value of the current one.
	 *
	 * @return DateInterval
	 */
	public function invert()
	{
		$interval = $this->copy($this->interval);
		$interval->invert = $interval->invert ? 0 : 1;

		return new DateInterval($interval);
	}

	/**
	 * Formats the interval.
	 *
	 * @param   string  $format  Format accepted by PHP DateInterval::format().
	 *
	 * @return string
	 */
	public function format($format)
	{
		return $this->interval->format($format);
	}

	/**
	 * Magic method to access properties of the interval.
	 *
	 * @param   string  $name  The name of the property.
	 *
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->interval->$name;
	}

	/**
	 * Returns a PHP DateInterval object.
	 *
	 * @return \DateInterval
	 */
	public function getDateInterval()
	{
		return $this->copy($this->interval);
	}

	/**
	 * Creates a copy of PHP DateInterval object.
	 *
	 * @param   \DateInterval  $interval  The object to copy.
	 *
	 * @return \DateInterval
	 */
	private static function copy(\DateInterval $interval)
	{
		$copy = new \DateInterval($interval->format('P%yY%mM%dDT%hH%iM%sS'));
		$copy->invert = $interval->invert;

		return $copy;
	}
}
