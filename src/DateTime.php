<?php

/**
 * Part of the Joomla Framework Date Package
 *
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\DateTime;

/**
 * DateTime class
 *
 * @property-read  string   $daysinmonth   t - Number of days in the given month.
 * @property-read  string   $dayofweek     N - ISO-8601 numeric representation of the day of the week.
 * @property-read  string   $dayofyear     z - The day of the year (starting from 0).
 * @property-read  boolean  $isleapyear    L - Whether it's a leap year.
 * @property-read  string   $day           d - Day of the month, 2 digits with leading zeros.
 * @property-read  string   $hour          H - 24-hour format of an hour with leading zeros.
 * @property-read  string   $minute        i - Minutes with leading zeros.
 * @property-read  string   $second        s - Seconds with leading zeros.
 * @property-read  string   $month         m - Numeric representation of a month, with leading zeros.
 * @property-read  string   $ordinal       S - English ordinal suffix for the day of the month, 2 characters.
 * @property-read  string   $week          W - Numeric representation of the day of the week.
 * @property-read  string   $year          Y - A full numeric representation of a year, 4 digits.
 *
 * @since  2.0
 */
class DateTime
{
	/** @var \DateTime */
	private $datetime;

	/**
	 * Constructor
	 *
	 * @param   string  $datetime
	 * @param   mixed   $timezone
	 */
	public function __construct($datetime = 'now', \DateTimeZone $timezone = null)
	{
		$this->datetime = new \DateTime($datetime, $timezone);
	}

	/**
	 * Magic method to access properties of the date given by class to the format method.
	 *
	 * @param   string  $name
	 *
	 * @return  mixed
	 */
	public function __get($name)
	{
		$value = null;

		switch ($name)
		{
			case 'daysinmonth':
				$value = $this->format('t');
				break;

			case 'dayofweek':
				$value = $this->format('N');
				break;

			case 'dayofyear':
				$value = $this->format('z');
				break;

			case 'isleapyear':
				$value = (boolean) $this->format('L');
				break;

			case 'day':
				$value = $this->format('d');
				break;

			case 'hour':
				$value = $this->format('H');
				break;

			case 'minute':
				$value = $this->format('i');
				break;

			case 'second':
				$value = $this->format('s');
				break;

			case 'month':
				$value = $this->format('m');
				break;

			case 'ordinal':
				$value = $this->format('S');
				break;

			case 'week':
				$value = $this->format('W');
				break;

			case 'year':
				$value = $this->format('Y');
				break;

			default:
				$trace = debug_backtrace();
				trigger_error(
					'Undefined property via __get(): ' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'],
					E_USER_NOTICE
				);
		}

		return $value;
	}

	public function add()
	{
		$datetime = clone $this->datetime;
		$datetime->add(new \DateInterval('P1D'));
		return new DateTime($datetime->format('Y-m-d H:i:s'));
	}

	public function format($format)
	{
		return $this->datetime->format($format);
	}

	public function toDateTime()
	{
		return clone $this->datetime;
	}

	public function toISO8601()
	{
		return $this->format(\DateTime::RFC3339);
	}

	public function toRFC822()
	{
		return $this->format(\DateTime::RFC2822);
	}

	public function toUnix()
	{
		return (int) $this->format('U');
	}
}
