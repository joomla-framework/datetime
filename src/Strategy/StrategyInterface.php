<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Strategy;

/**
 * Strategy Interface for a DateTime object
 *
 * @since  __DEPLOY_VERSION__
 */
interface StrategyInterface
{
	/**
	 * Sets time for the start of a day.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfDay(\DateTime $datetime);

	/**
	 * Sets time for the end of a day.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfDay(\DateTime $datetime);

	/**
	 * Sets time for the start of a week.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfWeek(\DateTime $datetime);

	/**
	 * Sets time for the end of a week.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfWeek(\DateTime $datetime);

	/**
	 * Sets time for the start of a month.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfMonth(\DateTime $datetime);

	/**
	 * Sets time for the end of a month.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfMonth(\DateTime $datetime);

	/**
	 * Sets time for the start of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfYear(\DateTime $datetime);

	/**
	 * Sets time for the end of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfYear(\DateTime $datetime);
}
