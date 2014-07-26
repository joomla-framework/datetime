<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

use Joomla\DateTime\Fixture\SchoolYearDateTime;

final class DateTimeStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
	 * @dataProvider seedForTest
	 */
	public function test(DateTime $expected, DateTime $actual)
    {
		$this->assertEquals($expected, $actual);
    }

	public function seedForTest()
	{
		$sut = new SchoolYearDateTime('2014-05-21 12:00:00');

		return array(
			array(new SchoolYearDateTime('2014-05-21 08:00:00'), $sut->startOfDay()),
			array(new SchoolYearDateTime('2014-05-21 16:00:00'), $sut->endOfDay()),
			array(new SchoolYearDateTime('2014-05-19 08:00:00'), $sut->startOfWeek()),
			array(new SchoolYearDateTime('2014-05-23 16:00:00'), $sut->endOfWeek()),
			array(new SchoolYearDateTime('2014-05-01 08:00:00'), $sut->startOfMonth()),
			array(new SchoolYearDateTime('2014-05-31 16:00:00'), $sut->endOfMonth()),
			array(new SchoolYearDateTime('2013-09-01 08:00:00'), $sut->startOfYear()),
			array(new SchoolYearDateTime('2014-06-30 16:00:00'), $sut->endOfYear()),
		);
	}

}