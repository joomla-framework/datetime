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
 * @since  2.0
 */
final class DateTime
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

	public static function createFromFormat($format, $time, \DateTimeZone $timezone = null)
	{
		$datetime = is_null($timezone) ? \DateTime::createFromFormat($format, $time)
									   : \DateTime::createFromFormat($format, $time, $timezone);
		$obj = new self();
		$obj->setDateTime($datetime);
		return $obj;
	}

	public static function create($year, $month = null, $day = null, $hour = null, $minute = null, $second = null, \DateTimeZone $timezone = null)
	{
		$month	= intval($month) < 1 ? 1 : $month;
		$day	= intval($day) < 1 ? 1 : $day;

		$time = sprintf('%04s-%02s-%02s %02s:%02s:%02s', $year, $month, $day, $hour, $minute, $second);
		return self::createFromFormat('Y-m-d H:i:s', $time, $timezone);
	}

	public static function createFromDate($year, $month = null, $day = null, \DateTimeZone $timezone = null)
	{
		return self::create($year, $month, $day, null, null, null, $timezone);
	}

	public static function createFromTime($hour = null, $minute = null, $second = null, \DateTimeZone $timezone = null)
	{
		return self::create(date('Y'), date('m'), date('d'), $hour, $minute, $second, $timezone);
	}

	public static function now()
	{
		return self::createFromTime(date('H'), date('i'), date('s'));
	}

	public static function today()
	{
		return self::createFromTime();
	}

	public static function yesterday()
	{
		$today = self::today();
		return $today->subDays(1);
	}

	public static function tomorrow()
	{
		$today = self::today();
		return $today->addDays(1);
	}

	public function after(DateTime $datetime)
	{
		return $this > $datetime;
	}

	public function before(DateTime $datetime)
	{
		return $this < $datetime;
	}

	public function equals(DateTime $datetime)
	{
		return $this == $datetime;
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

	public function beginOfDay()
	{
		return $this->modify(function(\DateTime $datetime) {
			$datetime->setTime(0, 0, 0);
		});
	}

	public function endOfDay()
	{
		return $this->modify(function(\DateTime $datetime) {
			$datetime->setTime(23, 59, 59);
		});
	}

	public function beginOfWeek()
	{
		$beginOfDay = $this->beginOfDay();

		// @todo maybe closure is better? e.g. for strategy later - to keep the same way of date' modifications?

		$diffInDays = 7 - intval($beginOfDay->format('N'));
		return $beginOfDay->subDays($diffInDays);
	}

	public function endOfWeek()
	{
		$endOfDay = $this->endOfDay();

		// @todo maybe closure is better? e.g. for strategy later - to keep the same way of date' modifications?

		$diffInDays = 7 - intval($endOfDay->format('N'));
		return $endOfDay->addDays($diffInDays);
	}

	public function beginOfMonth()
	{
		$beginOfDay = $this->beginOfDay();

		return $beginOfDay->modify(function(\DateTime $datetime) {
			$year = $datetime->format('Y');
			$month = $datetime->format('m');
			$datetime->setDate($year, $month, 1);
		});
	}

	public function endOfMonth()
	{
		$endOfDay = $this->endOfDay();

		return $endOfDay->modify(function(\DateTime $datetime) {
			$year = $datetime->format('Y');
			$month = $datetime->format('m');
			$day = $datetime->format('t');
			$datetime->setDate($year, $month, $day);
		});
	}

	public function beginOfYear()
	{
		$beginOfDay = $this->beginOfDay();

		return $beginOfDay->modify(function(\DateTime $datetime) {
			$year = $datetime->format('Y');
			$datetime->setDate($year, 1, 1);
		});
	}

	public function endOfYear()
	{
		$endOfDay = $this->endOfDay();

		return $endOfDay->modify(function(\DateTime $datetime) {
			$year = $datetime->format('Y');
			$datetime->setDate($year, 12, 31);
		});
	}

	public function format($format)
	{
		return $this->datetime->format($format);
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
		return clone $this->datetime->getTimezone();
	}

	/** @return \DateTime */
	public function getDateTime()
	{
		return clone $this->datetime;
	}

	private function setDateTime(\DateTime $datetime)
	{
		$this->datetime = clone $datetime;
	}

	private function calc($value, $format)
	{
		$value = intval($value);
		$spec = sprintf($format, abs($value));
		return $value > 0 ? $this->add(new \DateInterval($spec)) : $this->sub(new \DateInterval($spec));
	}

	private function modify($closure)
	{
		if(!is_callable($closure)) throw new \InvalidArgumentException(sprintf('Parameter for %s:modify() must be callable', get_class($this)));

		$datetime = clone $this->datetime;
		$closure($datetime);

		$obj = new self();
		$obj->setDateTime($datetime);
		return $obj;
	}
}
