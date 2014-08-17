<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Day-precision wrapper for a DateTime class.
 *
 * @since  2.0
 */
class Date
{
	/** @var DateTime */
	private $datetime;

	/**
	 * Constructor.
	 *
	 * @param   mixed  $date  Might be a Joomla\DateTime object or a PHP DateTime object
	 *                         or a string in a format accepted by strtotime().
	 */
	public function __construct($date)
	{
		if (!$date instanceof DateTime)
		{
			$date = new DateTime($date);
		}

		$this->datetime = $date->startOfDay();
	}

	/**
	 * Creates a Date object which represents today.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return Date
	 */
	public static function today(\DateTimeZone $timezone = null)
	{
		return new Date(DateTime::today($timezone));
	}

	/**
	 * Creates a Date object which represents tomorrow.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return Date
	 */
	public static function tomorrow(\DateTimeZone $timezone = null)
	{
		return new Date(DateTime::tomorrow($timezone));
	}

	/**
	 * Creates a Date object which represents yesterday.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return Date
	 */
	public static function yesterday(\DateTimeZone $timezone = null)
	{
		return new Date(DateTime::yesterday($timezone));
	}

	/**
	 * Checks if the current date is after the date given as parameter.
	 *
	 * @param   Date  $date  The date to compare to.
	 *
	 * @return boolean
	 */
	public function isAfter(Date $date)
	{
		return $this->datetime->isAfter($date->datetime);
	}

	/**
	 * Checks if the current date is before the date given as parameter.
	 *
	 * @param   Date  $date  The date to compare to.
	 *
	 * @return boolean
	 */
	public function isBefore(Date $date)
	{
		return $this->datetime->isBefore($date->datetime);
	}

	/**
	 * Checks if the current date is equals to the date given as parameter.
	 *
	 * @param   Date  $date  The date to compare to.
	 *
	 * @return boolean
	 */
	public function equals(Date $date)
	{
		return $this->datetime->equals($date->datetime);
	}

	/**
	 * Returns the difference between two objects.
	 *
	 * @param   Date     $date      The date to compare to.
	 * @param   boolean  $absolute  Should the interval be forced to be positive?
	 *
	 * @return DateInterval
	 */
	public function diff(Date $date, $absolute = false)
	{
		return $this->datetime->diff($date->datetime, $absolute);
	}

	/**
	 * Returns a new Date object by adding days to the current one.
	 *
	 * @param   integer  $value  Number of days to be added.
	 *
	 * @return Date
	 */
	public function addDays($value)
	{
		return new Date($this->datetime->addDays($value));
	}

	/**
	 * Returns a new Date object by subtracting days from the current one.
	 *
	 * @param   integer  $value  Number of days to be subtracted.
	 *
	 * @return Date
	 */
	public function subDays($value)
	{
		return new Date($this->datetime->subDays($value));
	}

	/**
	 * Returns a new Date object by adding weeks to the current one.
	 *
	 * @param   integer  $value  Number of weeks to be added.
	 *
	 * @return Date
	 */
	public function addWeeks($value)
	{
		return new Date($this->datetime->addWeeks($value));
	}

	/**
	 * Returns a new Date object by subtracting weeks from the current one.
	 *
	 * @param   integer  $value  Number of weeks to be subtracted.
	 *
	 * @return Date
	 */
	public function subWeeks($value)
	{
		return new Date($this->datetime->subWeeks($value));
	}

	/**
	 * Returns a new Date object by adding months to the current one.
	 *
	 * @param   integer  $value  Number of months to be added.
	 *
	 * @return Date
	 */
	public function addMonths($value)
	{
		return new Date($this->datetime->addMonths($value));
	}

	/**
	 * Returns a new Date object by subtracting months from the current one.
	 *
	 * @param   integer  $value  Number of months to be subtracted.
	 *
	 * @return Date
	 */
	public function subMonths($value)
	{
		return new Date($this->datetime->subMonths($value));
	}

	/**
	 * Returns a new Date object by adding years to the current one.
	 *
	 * @param   integer  $value  Number of years to be added.
	 *
	 * @return Date
	 */
	public function addYears($value)
	{
		return new Date($this->datetime->addYears($value));
	}

	/**
	 * Returns a new Date object by subtracting years from the current one.
	 *
	 * @param   integer  $value  Number of years to be subtracted.
	 *
	 * @return Date
	 */
	public function subYears($value)
	{
		return new Date($this->datetime->subYears($value));
	}

	/**
	 * Returns a new Date object representing a start of the current week.
	 *
	 * @return Date
	 */
	public function startOfWeek()
	{
		return new Date($this->datetime->startOfWeek());
	}

	/**
	 * Returns a new Date object representing the end of the current week.
	 *
	 * @return Date
	 */
	public function endOfWeek()
	{
		return new Date($this->datetime->endOfWeek());
	}

	/**
	 * Returns a new Date object representing a start of the current month.
	 *
	 * @return Date
	 */
	public function startOfMonth()
	{
		return new Date($this->datetime->startOfMonth());
	}

	/**
	 * Returns a new Date object representing the end of the current month.
	 *
	 * @return Date
	 */
	public function endOfMonth()
	{
		return new Date($this->datetime->endOfMonth());
	}

	/**
	 * Returns a new Date object representing a start of the current year.
	 *
	 * @return Date
	 */
	public function startOfYear()
	{
		return new Date($this->datetime->startOfYear());
	}

	/**
	 * Returns a new Date object representing the end of the current year.
	 *
	 * @return Date
	 */
	public function endOfYear()
	{
		return new Date($this->datetime->endOfYear());
	}

	/**
	 * Returns date formatted according to given format.
	 *
	 * @param   string  $format  Format accepted by date().
	 *
	 * @return string
	 */
	public function format($format)
	{
		return $this->datetime->format($format);
	}

	/**
	 * Returns the difference in a human readable format.
	 *
	 * @param   Date     $date         The date to compare to. Default is null and this means that
	 *                                  the current object will be compared to the current time.
	 * @param   integer  $detailLevel  How much details do you want to get
	 *
	 * @return string
	 */
	public function since(Date $date = null, $detailLevel = 1)
	{
		return $this->datetime->since(self::cast($date), $detailLevel);
	}

	/**
	 * Returns the almost difference in a human readable format.
	 *
	 * @param   Date  $date  The date to compare to. Default is null and this means that
	 *                        the current object will be compared to the current time.
	 *
	 * @return string
	 */
	public function sinceAlmost(Date $date = null)
	{
		return $this->datetime->sinceAlmost(self::cast($date));
	}

	/**
	 * Returns a PHP DateTime object.
	 *
	 * @return \DateTime
	 */
	public function getDateTime()
	{
		return $this->datetime->getDateTime();
	}

	/**
	 * Sets the Translator implementation.
	 *
	 * @param   Translator\Translator  $translator  The Translator implementation.
	 *
	 * @return void
	 */
	public static function setTranslator(Translator\Translator $translator)
	{
		DateTime::setTranslator($translator);
	}

	/**
	 * Sets the locale.
	 *
	 * @param   string  $locale  The locale to set.
	 *
	 * @return void
	 */
	public static function setLocale($locale)
	{
		DateTime::setLocale($locale);
	}

	/**
	 * Casts to DateTime.
	 *
	 * @param   Date  $date  Date to cast.
	 *
	 * @return DateTime | null
	 */
	private static function cast(Date $date = null)
	{
		if (!is_null($date))
		{
			$date = new DateTime($date);
		}

		return $date;
	}
}
