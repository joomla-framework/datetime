<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * DateRange class.
 *
 * @since  2.0
 */
final class DateRange implements \IteratorAggregate
{
	/** @var Date */
	private $start;

	/** @var Date */
	private $end;

	/**
	 * Constructor.
	 *
	 * @param   Date  $start  The start date.
	 * @param   Date  $end    The end date.
	 */
	public function __construct(Date $start, Date $end)
	{
		$this->start = $start;
		$this->end = $end;
	}

	/**
	 * Returns an empty range.
	 *
	 * @return DateRange
	 */
	public static function emptyRange()
	{
		return new DateRange(Date::tomorrow(), Date::yesterday());
	}

	/**
	 * Returns the start date.
	 *
	 * @return Date
	 */
	public function start()
	{
		return $this->start;
	}

	/**
	 * Returns the end date.
	 *
	 * @return Date
	 */
	public function end()
	{
		return $this->end;
	}

	/**
	 * Checks if a range is empty.
	 *
	 * @return booleans
	 */
	public function isEmpty()
	{
		return $this->start->isAfter($this->end);
	}

	/**
	 * Checks if the given date is included in the range.
	 *
	 * @param   Date  $date  The date to compare to.
	 *
	 * @return boolean
	 */
	public function includes(Date $date)
	{
		return !$date->isBefore($this->start) && !$date->isAfter($this->end);
	}

	/**
	 * Checks if ranges are equal.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return boolean
	 */
	public function equals(DateRange $range)
	{
		return $this->start->equals($range->start) && $this->end->equals($range->end);
	}

	/**
	 * Checks if ranges overlap with each other.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return boolean
	 */
	public function overlaps(DateRange $range)
	{
		return $range->includes($this->start) || $range->includes($this->end) || $this->includesRange($range);
	}

	/**
	 * Checks if the given range is included in the current one.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return boolean
	 */
	public function includesRange(DateRange $range)
	{
		return $this->includes($range->start) && $this->includes($range->end);
	}

	/**
	 * Returns a gap range between two ranges.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return DateRange
	 */
	public function gap(DateRange $range)
	{
		if ($this->overlaps($range))
		{
			return self::emptyRange();
		}

		$lower = $higher = null;

		if ($this->start->isBefore($range->start))
		{
			$lower = $this;
			$higher = $range;
		}
		else
		{
			$lower = $range;
			$higher = $this;
		}

		return new DateRange($lower->end->addDays(1), $higher->start->subDays(1));
	}

	/**
	 * Checks if ranges abuts with each other.
	 *
	 * @param   DateRange  $range  The range to compare to.
	 *
	 * @return boolean
	 */
	public function abuts(DateRange $range)
	{
		return !$this->overlaps($range) && $this->gap($range)->isEmpty();
	}

	/**
	 * Returns an array of dates which are included in the current range.
	 *
	 * @return Date[]
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
	 * @return \Iterator
	 */
	public function getIterator()
	{
		return new DateIterator($this->start, $this->end, new \DateInterval('P1D'));
	}

	/**
	 * Returns string representation of the range.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return sprintf('%s - %s', $this->start->format('Y-m-d'), $this->end->format('Y-m-d'));
	}

	/**
	 * Returns a range which is created by combination of given ranges. There can't
	 * be a gap between given ranges.
	 *
	 * @param   DateRange[]  $ranges  An array of ranges to combine.
	 *
	 * @return DateRange
	 *
	 * @throws \InvalidArgumentException
	 */
	public static function combination(array $ranges)
	{
		$ranges = self::sortArrayOfRanges($ranges);

		if (!self::isContiguous($ranges))
		{
			throw new \InvalidArgumentException('Unable to combine date ranges');
		}

		return new DateRange($ranges[0]->start, $ranges[count($ranges) - 1]->end);
	}

	/**
	 * Checks if ranges are contiguous.
	 *
	 * @param   DateRange[]  $ranges  An array of ranges to combine.
	 *
	 * @return boolean
	 */
	public static function isContiguous(array $ranges)
	{
		$ranges = self::sortArrayOfRanges($ranges);

		for ($i = 0; $i < count($ranges) - 1; $i++)
		{
			if (!$ranges[$i]->abuts($ranges[$i + 1]))
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * Sorts an array of ranges.
	 *
	 * @param   DateRange[]  $ranges  An array of ranges to sort.
	 *
	 * @return DateRange[]
	 */
	private static function sortArrayOfRanges(array $ranges)
	{
		usort(
			$ranges, function(DateRange $a, DateRange $b)
			{
				if ($a->equals($b))
				{
					return 0;
				}

				if ($a->start()->isAfter($b->start()))
				{
					return 1;
				}

				if ($a->start()->isBefore($b->start()) || $a->end()->isBefore($b->end()))
				{
					return -1;
				}

				return 1;
			}
		);

		return array_values($ranges);
	}
}
