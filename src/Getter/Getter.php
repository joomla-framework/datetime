<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Getter;

use Joomla\DateTime\DateTime;

/**
 * Getter Interface for a DateTime object
 *
 * @since  __DEPLOY_VERSION__
 */
interface Getter
{
	/**
	 * Return a value of the property.
	 *
	 * @param   DateTime  $datetime  The DateTime object.
	 * @param   string    $name      The name of the property.
	 *
	 * @return  mixed
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function get(DateTime $datetime, $name);
}
