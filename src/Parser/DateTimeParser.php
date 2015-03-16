<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Parser;

use Joomla\DateTime\DateTime;

/**
 * Default implementation of the Parser interface.
 *
 * @since  2.0.0
 */
final class DateTimeParser implements ParserInterface
{
	/**
	 * Parses to DateTime object.
	 *
	 * @param   string  $name   Name of the parser.
	 * @param   mixed   $value  The value to parse.
	 *
	 * @return  DateTime
	 *
	 * @since   2.0.0
	 * @throws  \BadMethodCallException
	 */
	public function parse($name, $value)
	{
		throw new \BadMethodCallException("Parser method '$name' doesn't exist.");
	}
}
