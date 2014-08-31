<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Getter;

/**
 * Getter Interface for a DateTime object
 *
 * @since  __DEPLOY_VERSION__
 */
interface GetterInterface
{
	/**
	 * Return a value of the property.
	 *
	 * @param   \Joomla\DateTime\DateTime  $datetime  The DateTime object.
	 * @param   string                     $name      The name of the property.
	 *
	 * @return  mixed
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function get(\Joomla\DateTime\DateTime $datetime, $name);
}
