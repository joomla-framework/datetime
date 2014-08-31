<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Test\Fixture;

use Joomla\DateTime\Date;

/**
 * Data provider for tests.
 *
 * @since  2.0
 */
final class DataProviderForDate
{
	/**
	 * Test cases for addDays.
	 *
	 * @return array
	 */
	public static function addDays()
	{
		$date1 = new Date('2014-07-01');
		$date2 = new Date('2014-07-31');

		return array(
			array($date1, 1,  new Date('2014-07-02')),
			array($date1, -1, new Date('2014-06-30')),
			array($date2, 1,  new Date('2014-08-01')),
			array($date2, -1, new Date('2014-07-30')),
		);
	}

	/**
	 * Test cases for subDays.
	 *
	 * @return array
	 */
	public static function subDays()
	{
		$date1 = new Date('2014-07-01');
		$date2 = new Date('2014-07-31');

		return array(
			array($date1, 1,  new Date('2014-06-30')),
			array($date1, -1, new Date('2014-07-02')),
			array($date2, 1,  new Date('2014-07-30')),
			array($date2, -1, new Date('2014-08-01')),
		);
	}

	/**
	 * Test cases for addWeeks.
	 *
	 * @return array
	 */
	public static function addWeeks()
	{
		$date1 = new Date('2014-07-01');
		$date2 = new Date('2014-07-31');

		return array(
			array($date1, 1,  new Date('2014-07-08')),
			array($date1, -1, new Date('2014-06-24')),
			array($date2, 1,  new Date('2014-08-07')),
			array($date2, -1, new Date('2014-07-24')),
		);
	}

	/**
	 * Test cases for subWeeks.
	 *
	 * @return array
	 */
	public static function subWeeks()
	{
		$date1 = new Date('2014-07-01');
		$date2 = new Date('2014-07-31');

		return array(
			array($date1, 1,  new Date('2014-06-24')),
			array($date1, -1, new Date('2014-07-08')),
			array($date2, 1,  new Date('2014-07-24')),
			array($date2, -1, new Date('2014-08-07')),
		);
	}

	/**
	 * Test cases for addMonths.
	 *
	 * @return array
	 */
	public static function addMonths()
	{
		$date1 = new Date('2014-08-01');
		$date2 = new Date('2014-08-31');
		$date3 = new Date('2014-12-01');
		$date4 = new Date('2014-12-31');
		$date5 = new Date('2014-01-31');

		return array(
			array($date1, 1,  new Date('2014-09-01')),
			array($date1, -1, new Date('2014-07-01')),
			array($date2, 1,  new Date('2014-09-30')),
			array($date2, -1, new Date('2014-07-31')),
			array($date3, 1,  new Date('2015-01-01')),
			array($date3, -1, new Date('2014-11-01')),
			array($date4, 1,  new Date('2015-01-31')),
			array($date4, -1, new Date('2014-11-30')),
			array($date5, 1,  new Date('2014-02-28')),
			array($date5, -1, new Date('2013-12-31')),
		);
	}

	/**
	 * Test cases for subMonths.
	 *
	 * @return array
	 */
	public static function subMonths()
	{
		$date1 = new Date('2014-08-01');
		$date2 = new Date('2014-08-31');
		$date3 = new Date('2014-12-01');
		$date4 = new Date('2014-12-31');
		$date5 = new Date('2014-01-31');

		return array(
			array($date1, 1,  new Date('2014-07-01')),
			array($date1, -1, new Date('2014-09-01')),
			array($date2, 1,  new Date('2014-07-31')),
			array($date2, -1, new Date('2014-09-30')),
			array($date3, 1,  new Date('2014-11-01')),
			array($date3, -1, new Date('2015-01-01')),
			array($date4, 1,  new Date('2014-11-30')),
			array($date4, -1, new Date('2015-01-31')),
			array($date5, 1,  new Date('2013-12-31')),
			array($date5, -1, new Date('2014-02-28')),
		);
	}

	/**
	 * Test cases for addYears.
	 *
	 * @return array
	 */
	public static function addYears()
	{
		$date1 = new Date('2014-07-01');
		$date2 = new Date('2016-02-29');

		return array(
			array($date1, 1,  new Date('2015-07-01')),
			array($date1, -1, new Date('2013-07-01')),
			array($date2, 1,  new Date('2017-02-28')),
			array($date2, -1, new Date('2015-02-28')),
		);
	}

	/**
	 * Test cases for subYears.
	 *
	 * @return array
	 */
	public static function subYears()
	{
		$date1 = new Date('2014-07-01');
		$date2 = new Date('2016-02-29');

		return array(
			array($date1, 1,  new Date('2013-07-01')),
			array($date1, -1, new Date('2015-07-01')),
			array($date2, 1,  new Date('2015-02-28')),
			array($date2, -1, new Date('2017-02-28')),
		);
	}
}
