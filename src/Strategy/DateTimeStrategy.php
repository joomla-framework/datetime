<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Strategy;

/**
 * Default implementation of Strategy interface.
 *
 * @since  __DEPLOY_VERSION__
 */
class DateTimeStrategy implements Strategy
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
	public function startOfDay(\DateTime $datetime)
	{
		$datetime->setTime(0, 0, 0);
	}

	/**
	 * Sets time for the end of a day.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfDay(\DateTime $datetime)
	{
		$datetime->setTime(23, 59, 59);
	}

	/**
	 * Sets time for the start of a week.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfWeek(\DateTime $datetime)
	{
		$diffInDays = intval($datetime->format('N')) - 1;
		$intervalSpec = sprintf('P%sD', $diffInDays);

		$datetime->sub(new \DateInterval($intervalSpec));
	}

	/**
	 * Sets time for the end of a week.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfWeek(\DateTime $datetime)
	{
		$diffInDays = 7 - intval($datetime->format('N'));
		$intervalSpec = sprintf('P%sD', $diffInDays);

		$datetime->add(new \DateInterval($intervalSpec));
	}

	/**
	 * Sets time for the start of a month.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfMonth(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$month = $datetime->format('m');

		$datetime->setDate($year, $month, 1);
	}

	/**
	 * Sets time for the end of a month.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfMonth(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$month = $datetime->format('m');
		$day = $datetime->format('t');

		$datetime->setDate($year, $month, $day);
	}

	/**
	 * Sets time for the start of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function startOfYear(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$datetime->setDate($year, 1, 1);
	}

	/**
	 * Sets time for the end of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function endOfYear(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$datetime->setDate($year, 12, 31);
	}
}
