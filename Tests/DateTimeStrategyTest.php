<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Test;

use Joomla\DateTime\DateTime;
use Joomla\DateTime\Test\Fixture\SchoolYear;

/**
 * Tests for DateTimeStrategy class.
 *
 * @since  2.0
 */
final class DateTimeStrategyTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Testing strategy.
	 *
	 * @param   DateTime  $expected  An expected object.
	 * @param   DateTime  $actual    An actual object.
	 *
	 * @return void
	 *
	 * @dataProvider seedForStrategy
	 */
	public function testCanModifyBehaviourOfDateTimeMethods(DateTime $expected, DateTime $actual)
	{
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Test cases for strategy.
	 *
	 * @return array
	 */
	public function seedForStrategy()
	{
		$sut = new SchoolYear('2014-05-21 12:00:00');

		return array(
			array(new SchoolYear('2014-05-21 08:00:00'), $sut->startOfDay()),
			array(new SchoolYear('2014-05-21 16:00:00'), $sut->endOfDay()),
			array(new SchoolYear('2014-05-19 08:00:00'), $sut->startOfWeek()),
			array(new SchoolYear('2014-05-23 16:00:00'), $sut->endOfWeek()),
			array(new SchoolYear('2014-05-01 08:00:00'), $sut->startOfMonth()),
			array(new SchoolYear('2014-05-31 16:00:00'), $sut->endOfMonth()),
			array(new SchoolYear('2013-09-01 08:00:00'), $sut->startOfYear()),
			array(new SchoolYear('2014-06-30 16:00:00'), $sut->endOfYear()),
		);
	}
}
