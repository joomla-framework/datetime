<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Since;

use Joomla\DateTime\DateInterval;
use Joomla\DateTime\DateTime;
use Joomla\DateTime\Translator\Translator;

/**
 * Default implemenation of Since interface.
 *
 * @since  2.0
 */
final class DateTimeSince implements Since
{
	/** @var Translator */
	private $translator;

	/**
	 * Returns the difference in a human readable format.
	 *
	 * @param   DateTime  $base         The base date.
	 * @param   DateTime  $datetime     The date to compare to. Default is null and this means that
	 *                                   the base date will be compared to the current time.
	 * @param   integer   $detailLevel  How much details do you want to get.
	 *
	 * @return string
	 */
	public function since(DateTime $base, DateTime $datetime = null, $detailLevel = 1)
	{
		list($item, $diff) = $this->calc($base, $datetime, $detailLevel);

		return $this->translator->get($item, array('time' => $this->parseUnits($diff)));
	}

	/**
	 * Returns the almost difference in a human readable format.
	 *
	 * @param   DateTime  $base      The base date.
	 * @param   DateTime  $datetime  The date to compare to. Default is null and this means that
	 *                                the base date will be compared to the current time.
	 *
	 * @return string
	 */
	public function almost(DateTime $base, DateTime $datetime = null)
	{
		list($item, $diff) = $this->calc($base, $datetime);

		return $this->translator->get($item, array('time' => $this->parseUnits($diff, true)));
	}

	/**
	 * Calculates the difference between dates.
	 *
	 * @param   DateTime  $base         The base date.
	 * @param   DateTime  $datetime     The date to compare to. Default is null and this means that
	 *                                   the base date will be compared to the current time.
	 *
	 * @param   integer   $detailLevel  How much details do you want to get.
	 *
	 * @return array()
	 */
	private function calc(DateTime $base, DateTime $datetime = null, $detailLevel = 1)
	{
		$this->translator = $base->getTranslator();

		$datetime = is_null($datetime) ? DateTime::now() : $datetime;
		$detailLevel = intval($detailLevel);

		$diff = $this->diffInUnits($base->diff($datetime, true), $detailLevel);

		$item = 'just_now';

		if (!$this->isNow($diff))
		{
			$item = $base->isAfter($datetime) ? 'in' : 'ago';
		}

		return array($item, $diff);
	}

	/**
	 * Calculates the difference between dates for all units of a time.
	 *
	 * @param   DateInterval  $interval     The difference between dates.
	 * @param   integer       $detailLevel  How much details do you want to get.
	 *
	 * @return array()
	 */
	private function diffInUnits(DateInterval $interval, $detailLevel)
	{
		$units = array('y' => 'year', 'm' => 'month', 'd' => 'day',
			'h' => 'hour', 'i' => 'minute', 's' => 'second'
		);

		$diff = array();

		foreach ($units as $format => $unit)
		{
			$amount = $interval->format('%' . $format);

			/** Adding support for weeks */
			if ($unit == 'day' && $amount >= 7)
			{
				$weeks = floor($amount / 7);
				$amount -= $weeks * 7;
				$diff[] = array(
					'amount' => $weeks,
					'unit' => 'week'
				);

				$detailLevel--;
			}

			/** Save only non-zero units of time */
			if ($amount > 0 && $detailLevel > 0)
			{
				$diff[] = array(
					'amount' => $amount,
					'unit' => $unit
				);

				$detailLevel--;
			}

			if ($detailLevel === 0)
			{
				break;
			}
		}

		return $diff;
	}

	/**
	 * Parses an array of units into a string.
	 *
	 * @param   array    $diff         An array of differences for every unit of a time.
	 * @param   boolean  $allowAlmost  Do you want to get an almost difference?
	 *
	 * @return string
	 */
	private function parseUnits($diff, $allowAlmost = false)
	{
		if (empty($diff))
		{
			return;
		}

		$isAlmost = false;
		$string = array();

		foreach ($diff as $time)
		{
			if ($allowAlmost)
			{
				$isAlmost = $this->isAlmost($time);
			}

			$string[] = $this->translator->choice($time['unit'], $time['amount']);
		}

		$parsed = $string[0];

		/** Add 'and' separator */
		if (count($string) > 1)
		{
			$theLastOne = $string[count($string) - 1];
			unset($string[count($string) - 1]);

			$and = $this->translator->get('and');
			$parsed = sprintf('%s %s %s', implode(', ', $string), $and, $theLastOne);
		}

		if ($isAlmost)
		{
			$parsed = $this->translator->get('almost', array('time' => $parsed));
		}

		return $parsed;
	}

	/**
	 * Checks if a time is more than 80% of the another unit of a time.
	 * (For example for 50 minutes it's FALSE, but for 55 minutes it's TRUE.)
	 *
	 * @param   array  &$time  An array of a time, eg: array('unit' => 'hour', 'amount' => 4)
	 *
	 * @return boolean
	 */
	private function isAlmost(&$time)
	{
		$units = array('second' => 60, 'minute' => 60, 'hour' => 24,
			'day' => 7, 'week' => 4, 'month' => 12, 'year' => null
		);

		/** Finds the next unit of a time */
		while (key($units) !== $time['unit'])
		{
			if (!next($units))
			{
				break;
			}
		}

		$current = current($units);
		next($units);

		/** Checks if the current amount is 'almost' the next one */
		if ($current && $current < $time['amount'] * 1.2)
		{
			$time = array(
				'amount' => 1,
				'unit' => key($units)
			);

			return true;
		}

		return false;
	}

	/**
	 * Checks if the difference can be treated as now.
	 *
	 * @param   array  $diff  An array of all units of a time
	 *
	 * @return boolean
	 */
	private function isNow($diff)
	{
		/** For all differences below one minute */
		return empty($diff) || $diff[0]['unit'] == 'second';
	}
}
