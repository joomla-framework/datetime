<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Fixture;

use Joomla\DateTime\DateTime;

class SchoolYearDateTime extends DateTime
{
	public function __construct($datetime, \DateTimeZone $timezone = null)
	{
		parent::__construct($datetime, $timezone);
		$this->setStrategy(new SchoolYearStrategy());
	}
}
