<?php

/**
 * Part of the Joomla Framework Date Package
 *
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\DateTime;

/**
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
 */
final class DateTime
{
	/** @var Getter\Getter */
	private static $getter;

	/** @var Since\Since */
	private static $since;

	/** @var Translator\Translator */
	private static $translator;

	/** @var Strategy\Strategy */
	private $strategy;

	/** @var \DateTime */
	private $datetime;

	public function __construct($datetime, \DateTimeZone $timezone = null)
	{
		if($datetime instanceof \DateTime) {
			$this->datetime = clone $datetime;
		} elseif($datetime instanceof Date) {
			$this->datetime = $datetime->getDateTime();
		} else {
			$this->datetime = new \DateTime($datetime);
		}

		if(!is_null($timezone)) {
			$this->datetime->setTimezone($timezone);
		}
	}

	public static function createFromFormat($format, $time, \DateTimeZone $timezone = null)
	{
		$datetime = is_null($timezone) ? \DateTime::createFromFormat($format, $time)
									   : \DateTime::createFromFormat($format, $time, $timezone);
		return new DateTime($datetime);
	}

	public static function create($year, $month = '01', $day = '01', $hour = '00', $minute = '00', $second = '00', \DateTimeZone $timezone = null)
	{
		$time = sprintf('%04s-%02s-%02s %02s:%02s:%02s', $year, $month, $day, $hour, $minute, $second);
		return self::createFromFormat('Y-m-d H:i:s', $time, $timezone);
	}

	public static function createFromDate($year, $month = '01', $day = '01', \DateTimeZone $timezone = null)
	{
		return self::create($year, $month, $day, '00', '00', '00', $timezone);
	}

	public static function createFromTime($hour = '00', $minute = '00', $second = '00', \DateTimeZone $timezone = null)
	{
		return self::create(date('Y'), date('m'), date('d'), $hour, $minute, $second, $timezone);
	}

	/** @return DateTime */
	public static function now()
	{
		return self::createFromTime(date('H'), date('i'), date('s'));
	}

	public static function today()
	{
		return self::createFromDate(date('Y'), date('m'), date('d'));
	}

	public static function tomorrow()
	{
		$today = self::today();
		return $today->addDays(1);
	}

	public static function yesterday()
	{
		$today = self::today();
		return $today->subDays(1);
	}

	public function isAfter(DateTime $datetime)
	{
		return $this->datetime > $datetime->datetime;
	}

	public function isBefore(DateTime $datetime)
	{
		return $this->datetime < $datetime->datetime;
	}

	public function equals(DateTime $datetime)
	{
		return $this->datetime == $datetime->datetime;
	}

	public function diff(DateTime $datetime, $absolute = false)
	{
		return $this->datetime->diff($datetime->datetime, $absolute);
	}

	public function add(\DateInterval $interval)
	{
		return $this->modify(function(\DateTime $datetime) use($interval) {
			$datetime->add($interval);
		});
	}

	public function sub(\DateInterval $interval)
	{
		return $this->modify(function(\DateTime $datetime) use($interval) {
			$datetime->sub($interval);
		});
	}

	public function addDays($value)
	{
		return $this->calc($value, 'P%dD');
	}

	public function subDays($value)
	{
		return $this->addDays(-intval($value));
	}

	public function addWeeks($value)
	{
		return $this->calc($value, 'P%dW');
	}

	public function subWeeks($value)
	{
		return $this->addWeeks(-intval($value));
	}

	public function addMonths($value)
	{
		return $this->calc($value, 'P%dM');
	}

	public function subMonths($value)
	{
		return $this->addMonths(-intval($value));
	}

	public function addYears($value)
	{
		return $this->calc($value, 'P%dY');
	}

	public function subYears($value)
	{
		return $this->addYears(-intval($value));
	}

	public function addSeconds($value)
	{
		return $this->calc($value, 'PT%dS');
	}

	public function subSeconds($value)
	{
		return $this->addSeconds(-intval($value));
	}

	public function addMinutes($value)
	{
		return $this->calc($value, 'PT%dM');
	}

	public function subMinutes($value)
	{
		return $this->addMinutes(-intval($value));
	}

	public function addHours($value)
	{
		return $this->calc($value, 'PT%dH');
	}

	public function subHours($value)
	{
		return $this->addHours(-intval($value));
	}

	public function startOfDay()
	{
		return $this->modify(array($this->getStrategy(), 'startOfDay'));
	}

	public function endOfDay()
	{
		return $this->modify(array($this->getStrategy(), 'endOfDay'));
	}

	public function startOfWeek()
	{
		$startOfDay = $this->startOfDay();
		return $startOfDay->modify(array($this->getStrategy(), 'startOfWeek'));
	}

	public function endOfWeek()
	{
		$endOfDay = $this->endOfDay();
		return $endOfDay->modify(array($this->getStrategy(), 'endOfWeek'));
	}

	public function startOfMonth()
	{
		$startOfDay = $this->startOfDay();
		return $startOfDay->modify(array($this->getStrategy(), 'startOfMonth'));
	}

	public function endOfMonth()
	{
		$endOfDay = $this->endOfDay();
		return $endOfDay->modify(array($this->getStrategy(), 'endOfMonth'));
	}

	public function startOfYear()
	{
		$startOfDay = $this->startOfDay();
		return $startOfDay->modify(array($this->getStrategy(), 'startOfYear'));
	}

	public function endOfYear()
	{
		$endOfDay = $this->endOfDay();
		return $endOfDay->modify(array($this->getStrategy(), 'endOfYear'));
	}

	public function format($format)
	{
		$replace = array();

		// Loop all format characters and check if we can translate them.
        for($i = 0; $i < strlen($format); $i++) {
            $character = $format[$i];

            // Check if we can replace it with a translated version.
            if (in_array($character, array('D', 'l', 'F', 'M')))
            {
                // Check escaped characters.
                if ($i > 0 and $format[$i-1] == '\\') continue;

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
                if (in_array($character, array('D', 'M'))) {
                    $translated = substr($translated, 0, 3);
                }

                // Add to replace list.
                if ($translated && $original != $translated) {
					$replace[$original] = $translated;
				}
            }
        }

        // Replace translations.
        if ($replace) {
            return str_replace(array_keys($replace), array_values($replace), $this->datetime->format($format));
        }

        return $this->datetime->format($format);
	}

	public function timeSince(DateTime $datetime = null, $detailLevel = 1)
	{
		return $this->getSince()->since($this, $datetime, $detailLevel);
	}

	public function almostTimeSince(DateTime $datetime = null)
	{
		return $this->getSince()->almost($this, $datetime);
	}

	public function __get($name)
	{
		return $this->getGetter()->get($this, $name);
	}

	public function getOffset()
	{
		return $this->datetime->getOffset();
	}

	public function getTimestamp()
	{
		return $this->datetime->getTimestamp();
	}

	public function getTimezone()
	{
		return $this->datetime->getTimezone();
	}

	public function getDateTime()
	{
		return clone $this->datetime;
	}

	/** @return Strategy\Strategy */
	public function getStrategy()
	{
		if(is_null($this->strategy)) {
			$this->strategy = new Strategy\DateTimeStrategy();
		}

		return $this->strategy;
	}

	public function toISO8601()
	{
		return $this->datetime->format(\DateTime::RFC3339);
	}

	public function toRFC822()
	{
		return $this->datetime->format(\DateTime::RFC2822);
	}

	public function toUnix()
	{
		return (int) $this->datetime->format('U');
	}

	public function setStrategy(Strategy\Strategy $strategy)
	{
		$this->strategy = $strategy;
	}

	public static function setSince(Since\Since $since)
	{
		static::$since = $since;
	}

	public static function setTranslator(Translator\Translator $translator)
	{
		static::$translator = $translator;
	}

	public static function setGetter(Getter\Getter $getter)
	{
		static::$getter = $getter;
	}

	public static function setLocale($locale)
	{
		static::getTranslator()->setLocale($locale);
	}

	/** @return Translator */
	public static function getTranslator()
	{
		if(is_null(static::$translator)) {
			static::$translator = new Translator\DateTimeTranslator();
		}

		return static::$translator;
	}

	private function calc($value, $format)
	{
		$value = intval($value);
		$spec = sprintf($format, abs($value));
		return $value > 0 ? $this->add(new \DateInterval($spec)) : $this->sub(new \DateInterval($spec));
	}

	private function modify(callable $callable)
	{
		$datetime = clone $this->datetime;
		call_user_func_array($callable, array($datetime));

		return new DateTime($datetime);
	}

	private static function getSince()
	{
		if(is_null(static::$since)) {
			static::$since = new Since\DateTimeSince();
		}

		return static::$since;
	}

	private static function getGetter()
	{
		if(is_null(static::$getter)) {
			static::$getter = new Getter\DateTimeGetter();
		}

		return static::$getter;
	}
}
