<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime;

/**
 * Iterator for ranges of DateTime objects.
 *
 * @since  2.0.0
 */
class DateTimeIterator implements \Iterator
{
	/**
	 * DateTime object representing the start date of the iterator
	 *
	 * @var    DateTime
	 * @since  2.0.0
	 */
	private $start;

	/**
	 * DateTime object representing the end date of the iterator
	 *
	 * @var    DateTime
	 * @since  2.0.0
	 */
	private $end;

	/**
	 * Interval between dates
	 *
	 * @var    DateInterval
	 * @since  2.0.0
	 */
	private $interval;

	/**
	 * DateTime object representing the current date
	 *
	 * @var    DateTime
	 * @since  2.0.0
	 */
	private $current;

	/**
	 * The key of the current date
	 *
	 * @var    integer
	 * @since  2.0.0
	 */
	private $key;

	/**
	 * Constructor.
	 *
	 * @param   DateTime      $start     The start date.
	 * @param   DateTime      $end       The end date.
	 * @param   DateInterval  $interval  The interval between adjacent dates.
	 *
	 * @since   2.0.0
	 */
	public function __construct(DateTime $start, DateTime $end, DateInterval $interval)
	{
		$this->start = $this->current = $start;
		$this->end = $end;
		$this->interval = $interval;
	}

	/**
	 * Returns the current date.
	 *
	 * @return  DateTime
	 *
	 * @since   2.0.0
	 */
	public function current()
	{
		return $this->current;
	}

	/**
	 * Returns the key of the current date.
	 *
	 * @return  integer
	 *
	 * @since   2.0.0
	 */
	public function key()
	{
		return $this->key;
	}

	/**
	 * Moves the current position to the next date.
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function next()
	{
		$this->key++;
		$this->current = $this->current->add($this->interval);
	}

	/**
	 * Rewinds back to the first date.
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function rewind()
	{
		$this->key = 0;
		$this->current = $this->start;
	}

	/**
	 * Checks if current position is valid.
	 *
	 * @return  boolean
	 *
	 * @since   2.0.0
	 */
	public function valid()
	{
		return !$this->current->isAfter($this->end);
	}
}
