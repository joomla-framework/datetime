<?php

namespace Joomla\DateTime\Since;

use Joomla\DateTime\DateTime;
use Joomla\DateTime\Translator\Translator;

final class DateTimeSince implements Since
{
	/** @var Translator */
	private $translator;

	public function since(DateTime $base, DateTime $datetime = null, $detailLevel = 1)
	{
		list($item, $diff) = $this->calc($base, $datetime, $detailLevel);
		return $this->translator->get($item, array('time' => $this->parseUnits($diff)));
	}

	public function almost(DateTime $base, DateTime $datetime = null)
	{
		list($item, $diff) = $this->calc($base, $datetime);
		return $this->translator->get($item, array('time' => $this->parseUnits($diff, true)));
	}

	private function calc(DateTime $base, DateTime $datetime = null, $detailLevel = 1)
	{
		$this->translator = $base->getTranslator();

		$datetime = is_null($datetime) ? DateTime::now() : $datetime;
		$detailLevel = intval($detailLevel);

		$diff = $this->diffInUnits($base->diff($datetime, true), $detailLevel);

		$item = 'just_now';
		if(!$this->isNow($diff)) {
			$item = $base->isAfter($datetime) ? 'in' : 'ago';
		}

		return array($item, $diff);
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

			$string[] = $this->translator->choice($time['unit'], $time['amount']);
		}

		$parsed = $string[0];

		/** Add 'and' separator */
		if(count($string) > 1) {
			$theLastOne = $string[count($string) - 1];
			unset($string[count($string) - 1]);

			$and = $this->translator->get('and');
			$parsed = sprintf('%s %s %s', implode(', ', $string), $and, $theLastOne);
		}

		if($isAlmost) {
			$parsed = $this->translator->get('almost', array('time' => $parsed));
		}

		return $parsed;
	}

	private function isAlmost(&$time)
	{
		$units = array('second'	=> 60, 'minute'	=> 60, 'hour' => 24,
			'day' => 7, 'week' => 4, 'month' => 12, 'year' => null
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
