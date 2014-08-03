<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Iterator for ranges of DateTime objects.
 *
 * @since  2.0
 */
class DateTimeIterator implements \Iterator
{
	/** @var DateTime */
	private $start;

	/** @var DateTime */
	private $end;

	/** @var DateInterval */
	private $interval;

	/** @var DateTime */
	private $current;

	/** @var integer */
	private $key;

	/**
	 * Constructor.
	 *
	 * @param   DateTime      $start     The start date.
	 * @param   DateTime      $end       The end date.
	 * @param   DateInterval  $interval  The interval between adjacent dates.
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
	 * @return Date
	 */
	public function current()
	{
		return $this->current;
	}

	/**
	 * Returns the key of the current date.
	 *
	 * @return integer
	 */
	public function key()
	{
		return $this->key;
	}

	/**
	 * Moves the current position to the next date.
	 *
	 * @return void
	 */
	public function next()
	{
		$this->key++;
		$this->current = $this->current->add($this->interval);
	}

	/**
	 * Rewinds back to the first date.
	 *
	 * @return void
	 */
	public function rewind()
	{
		$this->key = 0;
		$this->current = $this->start;
	}

	/**
	 * Checks if current position is valid.
	 *
	 * @return boolean
	 */
	public function valid()
	{
		return !$this->current->isAfter($this->end);
	}
}
