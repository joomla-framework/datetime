<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Parser;

use Joomla\DateTime\DateTime;

/**
 * AbstractParser.
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class AbstractParser implements ParserInterface
{
	/**
	 * Parses to DateTime object.
	 *
	 * @param   string  $name   Name of the parser.
	 * @param   mixed   $value  The value to parse.
	 *
	 * @return  DateTime
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function parse($name, $value)
	{
		return call_user_func_array(array($this, $name), array($value));
	}
}
