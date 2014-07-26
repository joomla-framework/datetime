<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Getter;

use Joomla\DateTime\DateTime;

/**
 * Getter.
 *
 * @since  2.0
 */
interface Getter
{
	/**
	 * Return a value of the property.
	 *
	 * @param   DateTime  $datetime  The DateTime object.
	 * @param   string    $name      The name of the property.
	 *
	 * @return string
	 */
	public function get(DateTime $datetime, $name);
}
