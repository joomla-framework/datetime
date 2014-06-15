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
class DateTime {

	/** @var \DateTime */
	private $datetime;

	/**
	 * Constructor
	 *
	 * @param   string  $datetime
	 * @param   mixed   $timezone
	 */
	public function __construct($datetime = 'now', \DateTimeZone $timezone = null) {
		$this->datetime = new \DateTime($datetime, $timezone);
	}

	public static function createFromFormat($format, $time, \DateTimeZone $timezone) {
		$datetime = \DateTime::createFromFormat($format, $time, $timezone);
		$obj = new self();
		$obj->setDateTime($datetime);
		return $obj;
	}

	
	public function add(\DateInterval $interval) {
		$datetime = clone $this->datetime;
		$datetime->add($interval);

		$obj = new self();
		$obj->setDateTime($datetime);

		return $obj;
	}

	public function sub(\DateInterval $interval) {
		$datetime = clone $this->datetime;
		$datetime->sub($interval);

		$obj = new self();
		$obj->setDateTime($datetime);

		return $obj;
	}

	public function addDays($value) {
		return $this->calc($value, 'P%dD');
	}

	public function addMonths($value) {
		return $this->calc($value, 'P%dM');
	}

	public function addYears($value) {
		return $this->calc($value, 'P%dY');
	}

	public function addSeconds($value) {
		return $this->calc($value, 'PT%dS');
	}

	public function addMinutes($value) {
		return $this->calc($value, 'PT%dM');
	}

	public function addHours($value) {
		return $this->calc($value, 'PT%dH');
	}

	public function getYesterday() {
		return $this->addDays(-1);
	}

	public function getTomorrow() {
		return $this->addDays(1);
	}

	public function getBeginOfWeek() {
		
	}

	public function getEndOfWeek() {
		
	}

	public function getBeginOnMonth() {
		
	}

	public function getEndOfMonth() {
		
	}

	public function getBeginOfYear() {
		
	}

	public function getEndOfYear() {
		
	}

	public function getBeginOfDay() {
		
	}

	public function getEndOfDay() {
		
	}

	public function format($format) {
		return $this->datetime->format($format);
	}

	public function getOffset() {
		return $this->datetime->getOffset();
	}

	public function getTimestamp() {
		return $this->datetime->getTimestamp();
	}

	public function getTimezone() {
		return clone $this->datetime->getTimezone();
	}

	/** @return \DateTime */
	public function toDateTime() {
		return clone $this->datetime;
	}

	private function setDateTime(\DateTime $datetime) {
		$this->datetime = clone $datetime;
	}

	private function calc($value, $format) {
		$value = intval($value);
		$spec = sprintf($format, abs($value));
		return $value > 0 ? $this->add(new \DateInterval($spec)) : $this->sub(new \DateInterval($spec));
	}

}
