<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Parser;

use Joomla\DateTime\DateTime;

/**
 * Default implemenation of Getter interface.
 *
 * @since  2.0
 */
final class DateTimeParser implements Parser
{
	/**
	 * Parses to DateTime object.
	 *
	 * @param   string  $name   Name of the parser.
	 * @param   mixed   $value  The value to parse.
	 *
	 * @return DateTime
	 */
	public function parse($name, $value)
	{
		throw new \BadMethodCallException("Parser method '$name' doesn't exist.");
	}
}
