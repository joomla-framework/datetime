<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Since;

use Joomla\DateTime\DateTime;

/**
 * Since.
 *
 * @since  2.0
 */
interface Since
{
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
	public function since(DateTime $base, DateTime $datetime, $detailLevel);

	/**
	 * Returns the almost difference in a human readable format.
	 *
	 * @param   DateTime  $base      The base date.
	 * @param   DateTime  $datetime  The date to compare to. Default is null and this means that
	 *                                the base date will be compared to the current time.
	 * 
	 * @return string
	 */
	public function almost(DateTime $base, DateTime $datetime);
}
