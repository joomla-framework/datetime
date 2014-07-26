<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Strategy;

/**
 * Strategy.
 *
 * @since  2.0
 */
interface Strategy
{
	/**
	 * Sets time for the start of a day.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function startOfDay(\DateTime $datetime);

	/**
	 * Sets time for the end of a day.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function endOfDay(\DateTime $datetime);

	/**
	 * Sets time for the start of a week.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function startOfWeek(\DateTime $datetime);

	/**
	 * Sets time for the end of a week.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function endOfWeek(\DateTime $datetime);

	/**
	 * Sets time for the start of a month.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function startOfMonth(\DateTime $datetime);

	/**
	 * Sets time for the end of a month.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function endOfMonth(\DateTime $datetime);

	/**
	 * Sets time for the start of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function startOfYear(\DateTime $datetime);

	/**
	 * Sets time for the end of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function endOfYear(\DateTime $datetime);
}
