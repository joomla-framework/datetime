<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Getter;

/**
 * Getter Interface for a DateTime object
 *
 * @since  2.0.0
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
	 * @since   2.0.0
	 */
	public function get(\Joomla\DateTime\DateTime $datetime, $name);
}
