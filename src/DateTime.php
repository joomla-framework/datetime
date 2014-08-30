<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * DateTime.
 *
 * @property-read  string   $daysinmonth  t - Number of days in the given month.
 * @property-read  string   $dayofweek    N - ISO-8601 numeric representation of the day of the week.
 * @property-read  string   $dayofyear    z - The day of the year (starting from 0).
 * @property-read  boolean  $isleapyear   L - Whether it's a leap year.
 * @property-read  string   $day          d - Day of the month, 2 digits with leading zeros.
 * @property-read  string   $hour         H - 24-hour format of an hour with leading zeros.
 * @property-read  string   $minute       i - Minutes with leading zeros.
 * @property-read  string   $second       s - Seconds with leading zeros.
 * @property-read  string   $month        m - Numeric representation of a month, with leading zeros.
 * @property-read  string   $ordinal      S - English ordinal suffix for the day of the month, 2 characters.
 * @property-read  string   $week         W - Numeric representation of the day of the week.
 * @property-read  string   $year         Y - A full numeric representation of a year, 4 digits.
 * @since          __DEPLOY_VERSION__
 */
class DateTime
{
	/**
	 * Getter Interface
	 *
	 * @var    Getter\Getter
	 * @since  __DEPLOY_VERSION__
	 */
	private static $getter;

	/**
	 * Parser Interface
	 *
	 * @var    Parser\Parser
	 * @since  __DEPLOY_VERSION__
	 */
	private static $parser;

	/**
	 * Since Interface
	 *
	 * @var    Since\Since
	 * @since  __DEPLOY_VERSION__
	 */
	private static $since;

	/**
	 * Translator object
	 *
	 * @var    Translator\Translator
	 * @since  __DEPLOY_VERSION__
	 */
	private static $translator;

	/**
	 * Strategy Interface
	 *
	 * @var    Strategy\Strategy
	 * @since  __DEPLOY_VERSION__
	 */
	private $strategy;

	/**
	 * PHP DateTime object
	 *
	 * @var    \DateTime
	 * @since  __DEPLOY_VERSION__
	 */
	private $datetime;

	/**
	 * Constructor.
	 *
	 * @param   mixed          $datetime  Either a Joomla\Date object, a PHP DateTime object
	 *                                    or a string in a format accepted by strtotime().
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __construct($datetime, \DateTimeZone $timezone = null)
	{
		if ($datetime instanceof \DateTime)
		{
			$this->datetime = clone $datetime;
		}
		elseif ($datetime instanceof Date)
		{
			$this->datetime = $datetime->getDateTime();
		}
		else
		{
			$this->datetime = new \DateTime($datetime);
		}

		if (!is_null($timezone))
		{
			$this->datetime->setTimezone($timezone);
		}
	}

	/**
	 * Parses to DateTime object.
	 *
	 * @param   string  $name   Name of the parser.
	 * @param   mixed   $value  The value to parse.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function parse($name, $value)
	{
		return static::getParser()->parse($name, $value);
	}

	/**
	 * Creates a DateTime object from the given format.
	 *
	 * @param   string         $format    Format accepted by date().
	 * @param   string         $time      String representing the time.
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function createFromFormat($format, $time, \DateTimeZone $timezone = null)
	{
		$datetime = is_null($timezone) ? \DateTime::createFromFormat($format, $time) : \DateTime::createFromFormat($format, $time, $timezone);

		return new static($datetime);
	}

	/**
	 * Creates a DateTime object.
	 *
	 * @param   integer        $year      The year.
	 * @param   integer        $month     The month.
	 * @param   integer        $day       The day of the month.
	 * @param   integer        $hour      The hour.
	 * @param   integer        $minute    The minute.
	 * @param   integer        $second    The second.
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function create($year, $month = '01', $day = '01', $hour = '00', $minute = '00', $second = '00', \DateTimeZone $timezone = null)
	{
		$time = sprintf('%04s-%02s-%02s %02s:%02s:%02s', $year, $month, $day, $hour, $minute, $second);

		return static::createFromFormat('Y-m-d H:i:s', $time, $timezone);
	}

	/**
	 * Creates a DateTime object with time of the midnight.
	 *
	 * @param   integer        $year      The year.
	 * @param   integer        $month     The month.
	 * @param   integer        $day       The day of the month.
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function createFromDate($year, $month = '01', $day = '01', \DateTimeZone $timezone = null)
	{
		return static::create($year, $month, $day, '00', '00', '00', $timezone);
	}

	/**
	 * Creates a DateTime object with date of today.
	 *
	 * @param   integer        $hour      The hour.
	 * @param   integer        $minute    The minute.
	 * @param   integer        $second    The second.
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function createFromTime($hour = '00', $minute = '00', $second = '00', \DateTimeZone $timezone = null)
	{
		return static::create(date('Y'), date('m'), date('d'), $hour, $minute, $second, $timezone);
	}

	/**
	 * Creates a DateTime object which represents now.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function now(\DateTimeZone $timezone = null)
	{
		return static::createFromTime(date('H'), date('i'), date('s'), $timezone);
	}

	/**
	 * Creates a DateTime object which represents today.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function today(\DateTimeZone $timezone = null)
	{
		return static::createFromDate(date('Y'), date('m'), date('d'), $timezone);
	}

	/**
	 * Creates a DateTime object which represents tomorrow.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function tomorrow(\DateTimeZone $timezone = null)
	{
		$today = static::today($timezone);

		return $today->addDays(1);
	}

	/**
	 * Creates a DateTime object which represents yesterday.
	 *
	 * @param   \DateTimeZone  $timezone  The timezone.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function yesterday(\DateTimeZone $timezone = null)
	{
		$today = static::today($timezone);

		return $today->subDays(1);
	}

	/**
	 * Checks if the current date is after the date given as parameter.
	 *
	 * @param   DateTime  $datetime  The date to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function isAfter(DateTime $datetime)
	{
		return $this->datetime > $datetime->datetime;
	}

	/**
	 * Checks if the current date is before the date given as parameter.
	 *
	 * @param   DateTime  $datetime  The date to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function isBefore(DateTime $datetime)
	{
		return $this->datetime < $datetime->datetime;
	}

	/**
	 * Checks if the current date is equals to the date given as parameter.
	 *
	 * @param   DateTime  $datetime  The date to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function equals(DateTime $datetime)
	{
		return $this->datetime == $datetime->datetime;
	}

	/**
	 * Returns the difference between two objects.
	 *
	 * @param   DateTime  $datetime  The date to compare to.
	 * @param   boolean   $absolute  Should the interval be forced to be positive?
	 *
	 * @return  DateInterval
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function diff(DateTime $datetime, $absolute = false)
	{
		return new DateInterval($this->datetime->diff($datetime->datetime, $absolute));
	}

	/**
	 * Returns a new DateTime object by adding an interval to the current one.
	 *
	 * @param   DateInterval  $interval  The interval to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function add(DateInterval $interval)
	{
		return $this->modify(
			function(\DateTime $datetime) use ($interval)
			{
				$datetime->add($interval->getDateInterval());
			}
		);
	}

	/**
	 * Returns a new DateTime object by subtracting an interval from the current one.
	 *
	 * @param   DateInterval  $interval  The interval to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function sub(DateInterval $interval)
	{
		return $this->modify(
			function(\DateTime $datetime) use ($interval)
			{
				$datetime->sub($interval->getDateInterval());
			}
		);
	}

	/**
	 * Returns a new DateTime object by adding the specified number of days to the current one.
	 *
	 * @param   integer  $value  Number of days to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addDays($value)
	{
		return $this->calc($value, 'P%dD');
	}

	/**
	 * Returns a new DateTime object by subtracting the specified number of days from the current one.
	 *
	 * @param   integer  $value  Number of days to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subDays($value)
	{
		return $this->addDays(-intval($value));
	}

	/**
	 * Returns a new DateTime object by adding the specified number of weeks to the current one.
	 *
	 * @param   integer  $value  Number of weeks to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addWeeks($value)
	{
		return $this->calc($value, 'P%dW');
	}

	/**
	 * Returns a new DateTime object by subtracting the specified number of weeks from the current one.
	 *
	 * @param   integer  $value  Number of weeks to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subWeeks($value)
	{
		return $this->addWeeks(-intval($value));
	}

	/**
	 * Returns a new DateTime object by adding the specified number of months to the current one.
	 *
	 * @param   integer  $value  Number of months to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addMonths($value)
	{
		return $this->fixMonth($this->calc($value, 'P%dM'));
	}

	/**
	 * Returns a new DateTime object by subtracting the specified number of months from the current one.
	 *
	 * @param   integer  $value  Number of months to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subMonths($value)
	{
		return $this->addMonths(-intval($value));
	}

	/**
	 * Returns a new DateTime object by adding the specified number of years to the current one.
	 *
	 * @param   integer  $value  Number of years to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addYears($value)
	{
		return $this->fixMonth($this->calc($value, 'P%dY'));
	}

	/**
	 * Returns a new DateTime object by subtracting the specified number of years from the current one.
	 *
	 * @param   integer  $value  Number of years to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subYears($value)
	{
		return $this->addYears(-intval($value));
	}

	/**
	 * Returns a new DateTime object by adding the specified number of seconds to the current one.
	 *
	 * @param   integer  $value  Number of seconds to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addSeconds($value)
	{
		return $this->calc($value, 'PT%dS');
	}

	/**
	 * Returns a new DateTime object by subtracting the specified number of seconds from the current one.
	 *
	 * @param   integer  $value  Number of seconds to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subSeconds($value)
	{
		return $this->addSeconds(-intval($value));
	}

	/**
	 * Returns a new DateTime object by adding the specified number of minutes to the current one.
	 *
	 * @param   integer  $value  Number of minutes to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addMinutes($value)
	{
		return $this->calc($value, 'PT%dM');
	}

	/**
	 * Returns a new DateTime object by subtracting the specified number of minutes from the current one.
	 *
	 * @param   integer  $value  Number of minutes to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subMinutes($value)
	{
		return $this->addMinutes(-intval($value));
	}

	/**
	 * Returns a new DateTime object by adding the specified number of hours to the current one.
	 *
	 * @param   integer  $value  Number of hours to be added.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function addHours($value)
	{
		return $this->calc($value, 'PT%dH');
	}

	/**
	 * Returns a new DateTime object by subtracting the specified number of hours from the current one.
	 *
	 * @param   integer  $value  Number of hours to be subtracted.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function subHours($value)
	{
		return $this->addHours(-intval($value));
	}

	/**
	 * Returns a new DateTime object representing the start of the current day.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfDay()
	{
		return $this->modify(array($this->getStrategy(), 'startOfDay'));
	}

	/**
	 * Returns a new DateTime object representing the end of the current day.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfDay()
	{
		return $this->modify(array($this->getStrategy(), 'endOfDay'));
	}

	/**
	 * Returns a new DateTime object representing the start of the current week.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfWeek()
	{
		$startOfDay = $this->startOfDay();

		return $startOfDay->modify(array($this->getStrategy(), 'startOfWeek'));
	}

	/**
	 * Returns a new DateTime object representing the end of the current week.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfWeek()
	{
		$endOfDay = $this->endOfDay();

		return $endOfDay->modify(array($this->getStrategy(), 'endOfWeek'));
	}

	/**
	 * Returns a new DateTime object representing the start of the current month.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfMonth()
	{
		$startOfDay = $this->startOfDay();

		return $startOfDay->modify(array($this->getStrategy(), 'startOfMonth'));
	}

	/**
	 * Returns a new DateTime object representing the end of the current month.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfMonth()
	{
		$endOfDay = $this->endOfDay();

		return $endOfDay->modify(array($this->getStrategy(), 'endOfMonth'));
	}

	/**
	 * Returns a new DateTime object representing the start of the current year.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfYear()
	{
		$startOfDay = $this->startOfDay();

		return $startOfDay->modify(array($this->getStrategy(), 'startOfYear'));
	}

	/**
	 * Returns a new DateTime object representing the end of the current year.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfYear()
	{
		$endOfDay = $this->endOfDay();

		return $endOfDay->modify(array($this->getStrategy(), 'endOfYear'));
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
		$replace = array();

		// Loop all format characters and check if we can translate them.
		for ($i = 0; $i < strlen($format); $i++)
		{
			$character = $format[$i];

			// Check if we can replace it with a translated version.
			if (in_array($character, array('D', 'l', 'F', 'M')))
			{
				switch ($character)
				{
					case 'D':
						$key = $this->datetime->format('l');
						break;
					case 'M':
						$key = $this->datetime->format('F');
						break;
					default:
						$key = $this->datetime->format($character);
				}

				$original = $this->datetime->format($character);
				$translated = $this->getTranslator()->get(strtolower($key));

				// Short notations.
				if (in_array($character, array('D', 'M')))
				{
					$translated = substr($translated, 0, 3);
				}

				// Add to replace list.
				if ($translated && $original != $translated)
				{
					$replace[$original] = $translated;
				}
			}
		}

		// Replace translations.
		if ($replace)
		{
			return str_replace(array_keys($replace), array_values($replace), $this->datetime->format($format));
		}

		return $this->datetime->format($format);
	}

	/**
	 * Returns the difference in a human readable format.
	 *
	 * @param   DateTime  $datetime     The date to compare to. Default is null and this means that
	 *                                   the current object will be compared to the current time.
	 * @param   integer   $detailLevel  How much details do you want to get.
	 *
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function since(DateTime $datetime = null, $detailLevel = 1)
	{
		return $this->getSince()->since($this, $datetime, $detailLevel);
	}

	/**
	 * Returns the almost difference in a human readable format.
	 *
	 * @param   DateTime  $datetime  The date to compare to. Default is null and this means that
	 *                                the current object will be compared to the current time.
	 *
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function sinceAlmost(DateTime $datetime = null)
	{
		return $this->getSince()->almost($this, $datetime);
	}

	/**
	 * Magic method to access properties of the date given by class to the format method.
	 *
	 * @param   string  $name  The name of the property.
	 *
	 * @return  mixed
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __get($name)
	{
		return $this->getGetter()->get($this, $name);
	}

	/**
	 * Alias for __get.
	 *
	 * @param   string  $name  The name of the property.
	 *
	 * @return  mixed
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function get($name)
	{
		return $this->$name;
	}

	/**
	 * Returns the timezone offset.
	 *
	 * @return  integer
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getOffset()
	{
		return $this->datetime->getOffset();
	}

	/**
	 * Returns the Unix timestamp representing the date.
	 *
	 * @return  integer
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getTimestamp()
	{
		return $this->datetime->getTimestamp();
	}

	/**
	 * Returns a DateTimeZone object.
	 *
	 * @return  \DateTimeZone
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getTimezone()
	{
		return $this->datetime->getTimezone();
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
		return clone $this->datetime;
	}

	/**
	 * Sets the Since implementation.
	 *
	 * @param   Since\Since  $since  The Since implementation.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function setSince(Since\Since $since)
	{
		static::$since = $since;
	}

	/**
	 * Sets the Translator implementation.
	 *
	 * @param   Translator\Translator  $translator  The Translator implementation.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function setTranslator(Translator\Translator $translator)
	{
		static::$translator = $translator;
	}

	/**
	 * Sets the Getter implementation.
	 *
	 * @param   Getter\Getter  $getter  The Getter implementation.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function setGetter(Getter\Getter $getter)
	{
		static::$getter = $getter;
	}

	/**
	 * Sets the Parser implementation.
	 *
	 * @param   Parser\Parser  $parser  The Parser implementation.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function setParser(Parser\Parser $parser)
	{
		static::$parser = $parser;
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
		static::getTranslator()->setLocale($locale);
	}

	/**
	 * Gets the Translator implementation.
	 *
	 * @return  Translator\Translator
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function getTranslator()
	{
		if (is_null(static::$translator))
		{
			static::$translator = new Translator\DateTimeTranslator;
		}

		return static::$translator;
	}

	/**
	 * Sets the Strategy implementation.
	 *
	 * @param   Strategy\Strategy  $strategy  The Strategy implementation.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	protected function setStrategy(Strategy\Strategy $strategy)
	{
		$this->strategy = $strategy;
	}

	/**
	 * Gets the Strategy implementation.
	 *
	 * @return  Strategy\Strategy
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	protected function getStrategy()
	{
		if (is_null($this->strategy))
		{
			$this->strategy = new Strategy\DateTimeStrategy;
		}

		return $this->strategy;
	}

	/**
	 * Creates a DateTime by adding or subtacting interval.
	 *
	 * @param   integer  $value   The value for the format.
	 * @param   string   $format  The interval_spec for sprintf(), eg. 'P%sD'.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private function calc($value, $format)
	{
		$value = intval($value);
		$spec = sprintf($format, abs($value));

		return $value > 0 ? $this->add(new DateInterval($spec)) : $this->sub(new DateInterval($spec));
	}

	/**
	 * Creates a DateTime object by calling the given callable.
	 *
	 * @param   callable  $callable  The callable with modifications of PHP DateTime object.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private function modify($callable)
	{
		$datetime = clone $this->datetime;
		call_user_func_array($callable, array($datetime));

		return new static($datetime);
	}

	/**
	 * If a day has changed, sets the date on the last day of the previous month.
	 *
	 * @param   DateTime  $result  A result of months or years addition
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private function fixMonth(DateTime $result)
	{
		if ($result->format('d') != $this->format('d'))
		{
			$result = $result->subMonths(1);
			$result->datetime->setDate($result->format('Y'), $result->format('m'), $result->format('t'));
		}

		return $result;
	}

	/**
	 * Gets the Since implementation.
	 *
	 * @return  Since\Since
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private static function getSince()
	{
		if (is_null(static::$since))
		{
			static::$since = new Since\DateTimeSince;
		}

		return static::$since;
	}

	/**
	 * Gets the Getter implementation.
	 *
	 * @return  Getter\Getter
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private static function getGetter()
	{
		if (is_null(static::$getter))
		{
			static::$getter = new Getter\DateTimeGetter;
		}

		return static::$getter;
	}

	/**
	 * Gets the Parser implementation.
	 *
	 * @return  Parser\Parser
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private static function getParser()
	{
		if (is_null(static::$parser))
		{
			static::$parser = new Parser\DateTimeParser;
		}

		return static::$parser;
	}
}
