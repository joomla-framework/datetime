<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Test\Fixture;

use Joomla\DateTime\Strategy\DateTimeStrategy;

/**
 * SchoolYearStrategy.
 *
 * @since  2.0
 */
class SchoolYearStrategy extends DateTimeStrategy
{
	/**
	 * Sets time for the start of a day.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function startOfDay(\DateTime $datetime)
	{
		$datetime->setTime(8, 0, 0);
	}

	/**
	 * Sets time for the end of a day.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function endOfDay(\DateTime $datetime)
	{
		$datetime->setTime(16, 0, 0);
	}

	/**
	 * Sets time for the start of a week.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
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
	 * @return void
	 */
	public function endOfWeek(\DateTime $datetime)
	{
		$diffInDays = 5 - intval($datetime->format('N'));
		$intervalSpec = sprintf('P%sD', $diffInDays);

		$datetime->add(new \DateInterval($intervalSpec));
	}

	/**
	 * Sets time for the start of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function startOfYear(\DateTime $datetime)
	{
		$year = intval($datetime->format('Y'));
		$month = intval($datetime->format('n'));

		if ($month < 9)
		{
			$year--;
		}

		$datetime->setDate($year, 9, 1);
	}

	/**
	 * Sets time for the end of a year.
	 *
	 * @param   \DateTime  $datetime  The DateTime object.
	 *
	 * @return void
	 */
	public function endOfYear(\DateTime $datetime)
	{
		$year = intval($datetime->format('Y'));
		$month = intval($datetime->format('n'));

		if ($month >= 9)
		{
			$year++;
		}

		$datetime->setDate($year, 6, 30);
	}
}
