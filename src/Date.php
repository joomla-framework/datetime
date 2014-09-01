<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime;

/**
 * Day-precision wrapper for a DateTime class.
 *
 * @since  __DEPLOY_VERSION__
 */
class Date
{
	/**
	 * DateTime object
	 *
	 * @var    DateTime
	 * @since  __DEPLOY_VERSION__
	 */
	private $datetime;

	/**
	 * Constructor.
	 *
	 * @param   mixed  $date  Either a Joomla\DateTime object, a PHP DateTime object
	 *                        or a string in a format accepted by strtotime().
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function today(\DateTimeZone $timezone = null)
	{
		return new static(DateTime::today($timezone));
	}

	/**
	 * Creates a Date object which represents tomorrow.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function tomorrow(\DateTimeZone $timezone = null)
	{
		return new static(DateTime::tomorrow($timezone));
	}

	/**
	 * Creates a Date object which represents yesterday.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function yesterday(\DateTimeZone $timezone = null)
	{
		return new static(DateTime::yesterday($timezone));
	}

	/**
	 * Checks if the current date is after the date given as parameter.
	 *
	 * @param   Date  $date  The date to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function isBefore(Date $date)
	{
		return $this->datetime->isBefore($date->datetime);
	}

	/**
	 * Checks if the current date is equal to the date given as parameter.
	 *
	 * @param   Date  $date  The date to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @return  DateInterval
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function diff(Date $date, $absolute = false)
	{
		return $this->datetime->diff($date->datetime, $absolute);
	}

	/**
	 * Returns a new Date object by adding the specified number of days to the current one.
	 *
	 * @param   integer  $value  Number of days to be added.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addDays($value)
	{
		return new static($this->datetime->addDays($value));
	}

	/**
	 * Returns a new Date object by subtracting the specified number of days from the current one.
	 *
	 * @param   integer  $value  Number of days to be subtracted.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subDays($value)
	{
		return new static($this->datetime->subDays($value));
	}

	/**
	 * Returns a new Date object by adding the specified number of weeks to the current one.
	 *
	 * @param   integer  $value  Number of weeks to be added.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addWeeks($value)
	{
		return new static($this->datetime->addWeeks($value));
	}

	/**
	 * Returns a new Date object by subtracting the specified number of weeks from the current one.
	 *
	 * @param   integer  $value  Number of weeks to be subtracted.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subWeeks($value)
	{
		return new static($this->datetime->subWeeks($value));
	}

	/**
	 * Returns a new Date object by adding the specified number of months to the current one.
	 *
	 * @param   integer  $value  Number of months to be added.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addMonths($value)
	{
		return new static($this->datetime->addMonths($value));
	}

	/**
	 * Returns a new Date object by subtracting the specified number of months from the current one.
	 *
	 * @param   integer  $value  Number of months to be subtracted.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subMonths($value)
	{
		return new static($this->datetime->subMonths($value));
	}

	/**
	 * Returns a new Date object by adding the specified number of years to the current one.
	 *
	 * @param   integer  $value  Number of years to be added.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addYears($value)
	{
		return new static($this->datetime->addYears($value));
	}

	/**
	 * Returns a new Date object by subtracting the specified number of years from the current one.
	 *
	 * @param   integer  $value  Number of years to be subtracted.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subYears($value)
	{
		return new static($this->datetime->subYears($value));
	}

	/**
	 * Returns a new Date object representing the start of the current week.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfWeek()
	{
		return new static($this->datetime->startOfWeek());
	}

	/**
	 * Returns a new Date object representing the end of the current week.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfWeek()
	{
		return new static($this->datetime->endOfWeek());
	}

	/**
	 * Returns a new Date object representing the start of the current month.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfMonth()
	{
		return new static($this->datetime->startOfMonth());
	}

	/**
	 * Returns a new Date object representing the end of the current month.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfMonth()
	{
		return new static($this->datetime->endOfMonth());
	}

	/**
	 * Returns a new Date object representing the start of the current year.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfYear()
	{
		return new static($this->datetime->startOfYear());
	}

	/**
	 * Returns a new Date object representing the end of the current year.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfYear()
	{
		return new static($this->datetime->endOfYear());
	}

	/**
	 * Returns date formatted according to given format.
	 *
	 * @param   string  $format  Format accepted by date().
	 *
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function sinceAlmost(Date $date = null)
	{
		return $this->datetime->sinceAlmost(self::cast($date));
	}

	/**
	 * Returns a PHP DateTime object.
	 *
	 * @return  \DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getDateTime()
	{
		return $this->datetime->getDateTime();
	}

	/**
	 * Sets the Translator implementation.
	 *
	 * @param   Translator\AbstractTranslator  $translator  The Translator implementation.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function setTranslator(Translator\AbstractTranslator $translator)
	{
		DateTime::setTranslator($translator);
	}

	/**
	 * Sets the locale.
	 *
	 * @param   string  $locale  The locale to set.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @return  DateTime|null
	 *
	 * @since   __DEPLOY_VERSION__
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
