<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Iterator for ranges of Date objects.
 *
 * @since  2.0
 */
class DateIterator extends DateTimeIterator
{
	/**
	 * Constructor.
	 *
	 * @param   Date  $start  The start date.
	 * @param   Date  $end    The end date.
	 */
	public function __construct(Date $start, Date $end)
	{
		parent::__construct(new DateTime($start), new DateTime($end), new DateInterval('P1D'));
	}

	/**
	 * Returns the current date.
	 *
	 * @return Date
	 */
	public function current()
	{
		return new Date(parent::current());
	}
}
