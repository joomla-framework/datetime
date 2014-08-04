<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime;

/**
 * Tests for DateTimeTranslator class.
 *
 * @since  2.0
 */
final class DateTimeTranslatorTest extends \PHPUnit_Framework_TestCase
{
	/** string */
	private $path;

	/** @var array */
	private $languages;

	/**
	 * Setting all up.
	 *
	 * @return void
	 */
	public function setUp()
	{
		$this->path = __DIR__ . '/../lang/';
		$this->languages = array_slice(str_replace('.php', '', scandir($this->path)), 2);
	}

	/**
	 * Testing since for polish.
	 *
	 * @param   integer   $detailLevel  A level of details for since method.
	 * @param   DateTime  $since        DateTime to test.
	 * @param   DateTime  $sut          DateTime to test.
	 * @param   string    $string       An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSince_pl
	 */
	public function testSince_pl($detailLevel, DateTime $since, DateTime $sut, $string)
	{
		DateTime::setLocale('pl');
		$this->assertEquals($string, $sut->since($since, $detailLevel));
	}

	/**
	 * Testing sinceAlmost for polish.
	 *
	 * @param   DateTime  $since   DateTime to test.
	 * @param   DateTime  $sut     DateTime to test.
	 * @param   string    $string  An expected string.
	 *
	 * @return void
	 *
	 * @dataProvider seedForSinceAlmost_pl
	 */
	public function testSinceAlmost_pl(DateTime $since, DateTime $sut, $string)
	{
		DateTime::setLocale('pl');
		$this->assertEquals($string, $sut->sinceAlmost($since));
	}

	/**
	 * Testing translations of months.
	 *
	 * @return void
	 */
	public function testTranslatesMonths()
	{
		$months = array(
			'january',
			'february',
			'march',
			'april',
			'may',
			'june',
			'july',
			'august',
			'september',
			'october',
			'november',
			'december'
		);

		foreach ($this->languages as $language)
		{
			$translations = include $this->path . $language . '.php';

			foreach ($months as $month)
			{
				$date = new DateTime("1 $month");
				$date->setLocale($language);

				$this->assertTrue(isset($translations[$month]));
				$this->assertEquals($translations[$month], $date->format('F'), "Language: $language");
				$this->assertEquals(substr($translations[$month], 0, 3), $date->format('M'), "Language: $language");
			}
		}
	}

	/**
	 * Testing translations of days.
	 *
	 * @return void
	 */
	public function testTranslatesDays()
	{
		$days = array(
			'monday',
			'tuesday',
			'wednesday',
			'thursday',
			'friday',
			'saturday',
			'sunday'
		);

		foreach ($this->languages as $language)
		{
			$translations = include $this->path . $language . '.php';

			foreach ($days as $day)
			{
				$date = new DateTime($day);
				$date->setLocale($language);

				$this->assertTrue(isset($translations[$day]));
				$this->assertEquals($translations[$day], $date->format('l'), "Language: $language");
				$this->assertEquals(substr($translations[$day], 0, 3), $date->format('D'), "Language: $language");
			}
		}
	}

	/**
	 * Testing some strings.
	 *
	 * @return void
	 */
	public function testTranslatesDiffForHumans()
	{
		$items = array(
			'in',
			'ago',
			'from_now',
			'just_now',
			'and',
			'almost',
			'after',
			'before',
			'year',
			'month',
			'week',
			'day',
			'hour',
			'minute',
			'second'
		);

		foreach ($this->languages as $language)
		{
			$translations = include $this->path . $language . '.php';

			foreach ($items as $item)
			{
				$this->assertTrue(isset($translations[$item]), "Language: $language, Item: $item");

				if (!$translations[$item])
				{
					echo "\nWARNING! '$item' not set for language $language";
					continue;
				}

				if (!in_array($item, array('just_now', 'and')))
				{
					if (in_array($item, array('in', 'almost', 'ago', 'from_now', 'after', 'before')))
					{
						$this->assertContains(':time', $translations[$item], "Language: $language");
					}
					else
					{
						$this->assertContains(':count', $translations[$item], "Language: $language");
					}
				}
			}
		}
	}

	/**
	 * Test cases for since in polish.
	 *
	 * @return array
	 */
	public function seedForSince_pl()
	{
		return Fixture\DataProviderForDateTime::since_pl();
	}

	/**
	 * Test cases for sinceAlmost in polish.
	 *
	 * @return array
	 */
	public function seedForSinceAlmost_pl()
	{
		return Fixture\DataProviderForDateTime::sinceAlmost_pl();
	}
}
