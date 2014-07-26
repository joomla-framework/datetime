<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Class representing a period of a time. You can create a period from start to end date,
 * but also from start date or end date for the given number of dates.
 *
 * @since  2.0
 */
class DateTimePeriod implements \IteratorAggregate
{
	/** @var DateTime */
	protected $start;

	/** @var DateTime */
	protected $end;

	/** @var \DateInterval */
	protected $interval;

	/** @var DateTime */
	protected $current;

	/** @var integer */
	protected $key;

	/**
	 * Constructor.
	 *
	 * @param   DateTime       $start     The start date.
	 * @param   DateTime       $end       The end date.
	 * @param   \DateInterval  $interval  The interval between adjacent dates.
	 */
	public function __construct(DateTime $start, DateTime $end, \DateInterval $interval)
	{
		$this->validate($start, $end, $interval);

		$this->start = $start;
		$this->end = $end;
		$this->interval = $interval;

		$this->current = $this->start;
		$this->key = 0;
	}

	/**
	 * Creates a DateTimePeriod object from the start date for the given amount od dates.
	 *
	 * @param   DateTime       $start     The start date.
	 * @param   integer        $amount    The amount of dates included in a period.
	 * @param   \DateInterval  $interval  The interval between adjacent dates.
	 *
	 * @return DateTimePeriod
	 */
	public static function from(DateTime $start, $amount, \DateInterval $interval)
	{
		$end = self::buildDatetime($start, $amount, $interval, true);

		return new DateTimePeriod($start, $end, $interval);
	}

	/**
	 * Creates a DateTimePeriod object to the end date for the given amount od dates.
	 *
	 * @param   DateTime       $end       The end date.
	 * @param   integer        $amount    The amount of dates included in a period.
	 * @param   \DateInterval  $interval  The interval between adjacent dates.
	 *
	 * @return DateTimePeriod
	 */
	public static function to(DateTime $end, $amount, \DateInterval $interval)
	{
		$start = self::buildDatetime($end, $amount, $interval, false);

		return new DateTimePeriod($start, $end, $interval);
	}

	/**
	 * Returns an array of dates which are included in the current range.
	 *
	 * @return DateTime[]
	 */
	public function toArray()
	{
		$period = array();

		foreach ($this as $datetime)
		{
			$period[] = $datetime;
		}

		return $period;
	}

	/**
	 * Returns an external iterator.
	 *
	 * @return \Iterator
	 */
	public function getIterator()
	{
		return new DateTimeIterator($this->start, $this->end, $this->interval);
	}

	/**
	 * Validates inputs from the constructor.
	 *
	 * @param   DateTime       $start     The start date.
	 * @param   DateTime       $end       The end date.
	 * @param   \DateInterval  $interval  The interval between adjacent dates.
	 *
	 * @return void
	 *
	 * @throws \InvalidArgumentException
	 */
	private function validate(DateTime $start, DateTime $end, \DateInterval $interval)
	{
		if (!$start->isBefore($end))
		{
			throw new \InvalidArgumentException("Start object have to be before the end object");
		}

		if ($start->add($interval)->isAfter($end))
		{
			throw new \InvalidArgumentException("Interval is too big");
		}
	}

	/**
	 * Validates inputs from the constructor.
	 *
	 * @param   DateTime       $base        The base date.
	 * @param   integer        $amount      The amount of dates included in a period.
	 * @param   \DateInterval  $interval    The interval between adjacent dates.
	 * @param   boolean        $byAddition  Should build the final date using addition or subtraction?
	 *
	 * @return DateTime
	 *
	 * @throws \InvalidArgumentException
	 */
	private static function buildDatetime(DateTime $base, $amount, \DateInterval $interval, $byAddition = true)
	{
		if (intval($amount) < 2)
		{
			throw new \InvalidArgumentException('Amount have to be greater than 2');
		}

		/** Start from 2, because start date and end date also count */
		for ($i = 2; $i <= $amount; $i++)
		{
			$base = $byAddition ? $base->add($interval) : $base->sub($interval);
		}

		return $base;
	}
}
