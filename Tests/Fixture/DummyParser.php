<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Test\Fixture;

use Joomla\DateTime\Date;
use Joomla\DateTime\DateTime;
use Joomla\DateTime\Parser\AbstractParser;

/**
 * DummyParser.
 *
 * @since  2.0
 */
final class DummyParser extends AbstractParser
{
	/**
	 * Parses from string.
	 *
	 * @param   string  $value  A value to parse.
	 *
	 * @return DateTime
	 */
	public function fromString($value)
	{
		return new DateTime($value);
	}

	/**
	 * Parses from Date.
	 *
	 * @param   Date  $date  A Date to parse.
	 *
	 * @return DateTime
	 */
	public function fromDate(Date $date)
	{
		return new DateTime($date);
	}

	/**
	 * Parses from PHP DateTime.
	 *
	 * @param   \DateTime  $datetime  A PHP DateTime to parse.
	 *
	 * @return DateTime
	 */
	public function fromPHPDateTime(\DateTime $datetime)
	{
		return new DateTime($datetime);
	}
}
