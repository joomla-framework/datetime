<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Since;

use Joomla\DateTime\DateTime;

/**
 * Since Interface for a DateTime object
 *
 * @since  __DEPLOY_VERSION__
 */
interface SinceInterface
{
	/**
	 * Returns the difference in a human readable format.
	 *
	 * @param   DateTime  $base         The base date.
	 * @param   DateTime  $datetime     The date to compare to. Default is null and this means that
	 *                                  the base date will be compared to the current time.
	 * @param   integer   $detailLevel  The level of detail to retrieve.
	 *
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function since(DateTime $base, DateTime $datetime = null, $detailLevel = 1);

	/**
	 * Returns the almost difference in a human readable format.
	 *
	 * @param   DateTime  $base      The base date.
	 * @param   DateTime  $datetime  The date to compare to. Default is null and this means that
	 *                               the base date will be compared to the current time.
	 *
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function almost(DateTime $base, DateTime $datetime = null);
}
