<?php

namespace Joomla\DateTime\Since;

use Joomla\DateTime\DateTime;

final class DateTimeSince implements Since
{
	public function since(DateTime $base, DateTime $datetime = null, $detailLevel = 1)
	{
		list($format, $diff) = $this->calc($base, $datetime, $detailLevel);
		return sprintf($format, $this->parseUnits($diff));
	}

	public function almost(DateTime $base, DateTime $datetime = null)
	{
		list($format, $diff) = $this->calc($base, $datetime);
		return sprintf($format, $this->parseUnits($diff, true));
	}

	private function calc(DateTime $base, DateTime $datetime = null, $detailLevel = 1)
	{
		$datetime = is_null($datetime) ? DateTime::now() : $datetime;
		$detailLevel = intval($detailLevel);

		$diff = $this->diffInUnits($base->diff($datetime, true), $detailLevel);

		$format = 'just now';
		if(!$this->isNow($diff)) {
			$format = $base->isAfter($datetime) ? 'in %s' : '%s ago';
		}

		return array($format, $diff);
	}

	private function diffInUnits(\DateInterval $interval, $detailLevel)
	{
		$units = array('y' => 'year', 'm' => 'month', 'd' => 'day',
			'h' => 'hour', 'i' => 'minute', 's' => 'second'
		);

		$diff = array();
		foreach($units as $format => $unit) {
			$amount = $interval->format('%' . $format);

			/** Adding support for weeks */
			if($unit == 'day' && $amount >= 7) {
				$weeks = floor($amount / 7);
				$amount -= $weeks * 7;
				$diff[] = array(
					'amount' => $weeks,
					'unit' => 'week'
				);

				$detailLevel--;
			}

			/** Save only non-zero units of time */
			if($amount > 0 && $detailLevel > 0) {
				$diff[] = array(
					'amount' => $amount,
					'unit' => $unit
				);

				$detailLevel--;
			}

			if($detailLevel === 0) {
				break;
			}
		}

		return $diff;
	}

	private function parseUnits($units, $allowAlmost = false)
	{
		if(empty($units)) return;

		$isAlmost = false;
		$string = array();
		foreach($units as $time) {
			if($allowAlmost) {
				$isAlmost = $this->isAlmost($time);
			}

			if($time['amount'] > 1) {
				$time['unit'] .= 's';
			}
			$string[] = implode(' ', $time);
		}

		$parsed = $string[0];

		/** Add 'and' separator */
		if(count($string) > 1) {
			$theLastOne = $string[count($string) - 1];
			unset($string[count($string) - 1]);

			$parsed = sprintf('%s and %s', implode(', ', $string), $theLastOne);
		}

		if($isAlmost) {
			$parsed = sprintf('almost %s', $parsed);
		}

		return $parsed;
	}

	private function isAlmost(&$time)
	{
		$units = array('second'	=> 60, 'minute'	=> 60, 'hour' => 24,
			'day' => 7, 'week' => 4.35, 'month'	=> 12, 'year' => null
		);

		do {
			$current = current($units);
		} while(key($units) !== $time['unit'] && next($units));
		next($units);

		if($current && $current < $time['amount'] * 1.2) {
			$time = array(
				'amount' => 1,
				'unit' => key($units)
			);
			return true;
		}

		return false;
	}

	private function isNow($diff)
	{
		/** For all differences below one minute */
		return empty($diff) || $diff[0]['unit'] == 'second';
	}
}
