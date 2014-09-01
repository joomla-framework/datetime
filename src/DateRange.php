<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime;

/**
 * DateRange class.
 *
 * @since  __DEPLOY_VERSION__
 */
final class DateRange implements \IteratorAggregate
{
	/**
	 * DateTimeRange object
	 *
	 * @var    DateTimeRange
	 * @since  __DEPLOY_VERSION__
	 */
	private $range;

	/**
	 * Constructor.
	 *
	 * @param   Date  $start  The start date.
	 * @param   Date  $end    The end date.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __construct(Date $start, Date $end)
	{
		$this->range = new DateTimeRange(new DateTime($start), new DateTime($end), new DateInterval('P1D'));
	}

	/**
	 * Creates a DateRange object from the start date for the given amount of days.
	 *
	 * @param   Date     $start   The start date.
	 * @param   integer  $amount  The amount of dates included in a range.
	 *
	 * @return  DateRange
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function from(Date $start, $amount)
	{
		return self::cast(DateTimeRange::from(new DateTime($start), $amount, new DateInterval('P1D')));
	}

	/**
	 * Creates a DateRange object to the end date for the given amount of days.
	 *
	 * @param   Date     $end     The end date.
	 * @param   integer  $amount  The amount of dates included in a range.
	 *
	 * @return  DateRange
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function to(Date $end, $amount)
	{
		return self::cast(DateTimeRange::to(new DateTime($end), $amount, new DateInterval('P1D')));
	}

	/**
	 * Returns an empty range.
	 *
	 * @return  DateRange
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function emptyRange()
	{
		return self::cast(DateTimeRange::emptyRange());
	}

	/**
	 * Returns the start date.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function start()
	{
		return new Date($this->range->start());
	}

	/**
	 * Returns the end date.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function end()
	{
		return new Date($this->range->end());
	}

	/**
	 * Checks if a range is empty.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function isEmpty()
	{
		return $this->range->isEmpty();
	}

	/**
	 * Checks if the given date is included in the range.
	 *
	 * @param   Date  $date  The date to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function includes(Date $date)
	{
		return $this->range->includes(new DateTime($date));
	}

	/**
	 * Checks if ranges are equal.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function equals(DateRange $range)
	{
		return $this->range->equals($range->range);
	}

	/**
	 * Checks if ranges overlap with each other.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function overlaps(DateRange $range)
	{
		return $this->range->overlaps($range->range);
	}

	/**
	 * Checks if the given range is included in the current one.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function includesRange(DateRange $range)
	{
		return $this->range->includesRange($range->range);
	}

	/**
	 * Returns a gap range between two ranges.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return  DateRange
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function gap(DateRange $range)
	{
		return self::cast($this->range->gap($range->range));
	}

	/**
	 * Checks if ranges abuts with each other.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function abuts(DateRange $range)
	{
		return $this->range->abuts($range->range);
	}

	/**
	 * Returns an array of dates which are included in the current range.
	 *
	 * @return  Date[]
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function toArray()
	{
		$range = array();

		foreach ($this as $day)
		{
			$range[] = $day;
		}

		return $range;
	}

	/**
	 * Returns an external iterator.
	 *
	 * @return  DateIterator
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getIterator()
	{
		return new DateIterator($this->start(), $this->end());
	}

	/**
	 * Returns string representation of the range.
	 *
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __toString()
	{
		return sprintf('%s - %s', $this->start()->format('Y-m-d'), $this->end()->format('Y-m-d'));
	}

	/**
	 * Returns a range which is created by combination of given ranges. There can't
	 * be a gap between given ranges.
	 *
	 * @param   DateRange[]  $ranges  An array of ranges to combine.
	 *
	 * @return  DateRange
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function combination(array $ranges)
	{
		$dateTimeRanges = array();

		foreach ($ranges as $range)
		{
			$dateTimeRanges[] = $range->range;
		}

		return self::cast(DateTimeRange::combination($dateTimeRanges));
	}

	/**
	 * Checks if ranges are contiguous.
	 *
	 * @param   DateRange[]  $ranges  An array of ranges to combine.
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function isContiguous(array $ranges)
	{
		$dateTimeRange = array();

		foreach ($ranges as $range)
		{
			$dateTimeRange[] = $range->range;
		}

		return DateTimeRange::isContiguous($dateTimeRange);
	}

	/**
	 * Casts an DateTimeRange object into DateRange.
	 *
	 * @param   DateTimeRange  $range  A DateTimeRange object
	 *
	 * @return  DateRange
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private static function cast(DateTimeRange $range)
	{
		$start = new Date($range->start());
		$end   = new Date($range->end());

		return new DateRange($start, $end);
	}
}
