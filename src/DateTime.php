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

	public static function createFromFormat($format, $time, \DateTimeZone $timezone = null)
	{
		$datetime = is_null($timezone) ? \DateTime::createFromFormat($format, $time)
									   : \DateTime::createFromFormat($format, $time, $timezone);
		$obj = new self();
		$obj->setDateTime($datetime);
		return $obj;
	}

	public static function createFromDateTime($year, $month = null, $day = null, $hour = null, $minute = null, $second = null, \DateTimeZone $timezone = null)
	{
		$month	= intval($month) < 1 ? 1 : $month;
		$day	= intval($day) < 1 ? 1 : $day;

		$time = sprintf('%d-%d-%d %d:%d:%d', $year, $month, $day, $hour, $minute, $second);
		return new self($time, $timezone);
	}

	public static function createFromDate($year, $month = null, $day = null, \DateTimeZone $timezone = null)
	{
		return self::createFromDateTime($year, $month, $day, null, null, null, $timezone);
	}

	public static function createFromTime($hour = null, $minute = null, $second = null, \DateTimeZone $timezone = null)
	{
		return self::createFromDateTime(date('Y'), date('m'), date('d'), $hour, $minute, $second, $timezone);
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

	public function getYesterday()
	{
		return $this->addDays(-1);
	}

	public function getTomorrow()
	{
		return $this->addDays(1);
	}

	public function getBeginOfDay()
	{
		return $this->modify(function(\DateTime $datetime) {
			$datetime->setTime(0, 0, 0);
		});
	}

	public function getEndOfDay()
	{
		return $this->modify(function(\DateTime $datetime) {
			$datetime->setTime(23, 59, 59);
		});
	}

	public function getBeginOfWeek()
	{

	}

	public function getEndOfWeek()
	{

	}

	public function getBeginOnMonth()
	{

	}

	public function getEndOfMonth()
	{

	}

	public function getBeginOfYear()
	{

	}

	public function getEndOfYear()
	{

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
	public function toDateTime()
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
