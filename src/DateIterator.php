<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime;

/**
 * Iterator for ranges of Date objects.
 *
 * @since  __DEPLOY_VERSION__
 */
class DateIterator extends DateTimeIterator
{
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
		parent::__construct(new DateTime($start), new DateTime($end), new DateInterval('P1D'));
	}

	/**
	 * Returns the current date.
	 *
	 * @return  Date
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function current()
	{
		return new Date(parent::current());
	}
}
