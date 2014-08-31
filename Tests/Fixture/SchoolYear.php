<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Test\Fixture;

use Joomla\DateTime\DateTime;

/**
 * SchoolYearDateTime.
 *
 * @since  2.0
 */
class SchoolYear extends DateTime
{
	/**
	 * Constructor.
	 *
	 * @param   mixed          $datetime  Might be a Joomla\Date object or a PHP DateTime object
	 *                                     or a string in a format accepted by strtotime().
	 * @param   \DateTimeZine  $timezone  The timezone.
	 */
	public function __construct($datetime, \DateTimeZone $timezone = null)
	{
		parent::__construct($datetime, $timezone);
		$this->setStrategy(new SchoolYearStrategy);
	}
}
