<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Iterator for ranges of DateTime objects.
 *
 * @since  __DEPLOY_VERSION__
 */
class DateTimeIterator implements \Iterator
{
	/**
	 * DateTime object representing the start date of the iterator
	 *
	 * @var    DateTime
	 * @since  __DEPLOY_VERSION__
	 */
	private $start;

	/**
	 * DateTime object representing the end date of the iterator
	 *
	 * @var    DateTime
	 * @since  __DEPLOY_VERSION__
	 */
	private $end;

	/**
	 * Interval between dates
	 *
	 * @var    DateInterval
	 * @since  __DEPLOY_VERSION__
	 */
	private $interval;

	/**
	 * DateTime object representing the current date
	 *
	 * @var    DateTime
	 * @since  __DEPLOY_VERSION__
	 */
	private $current;

	/**
	 * The key of the current date
	 *
	 * @var    integer
	 * @since  __DEPLOY_VERSION__
	 */
	private $key;

	/**
	 * Constructor.
	 *
	 * @param   DateTime      $start     The start date.
	 * @param   DateTime      $end       The end date.
	 * @param   DateInterval  $interval  The interval between adjacent dates.
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @since   __DEPLOY_VERSION__
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
	 * @since   __DEPLOY_VERSION__
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
	 * @since   __DEPLOY_VERSION__
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
	 * @since   __DEPLOY_VERSION__
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
	 * @since   __DEPLOY_VERSION__
	 */
	public function valid()
	{
		return !$this->current->isAfter($this->end);
	}
}
