<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Fixture;

use Joomla\DateTime\DateTime;

/**
 * Data provider for tests.
 *
 * @since  2.0
 */
final class DataProviderForDateTime
{
	/**
	 * Test cases for create.
	 *
	 * @return array
	 */
	public static function createFactoryMethod()
	{
		return array(
			array('2014', '06', '12', '08', '04', '09', new DateTime('2014-06-12 08:04:09')),
			array(2014, 6, 12, 8, 4, 9,	new DateTime('2014-06-12 08:04:09')),
			array(2014, 6, 12, 8, 4, 0,	new DateTime('2014-06-12 08:04:00')),
			array(2014, 6, 12, 8, 0, 0,	new DateTime('2014-06-12 08:00:00')),
			array(2014, 6, 12, 0, 0, 0,	new DateTime('2014-06-12 00:00:00')),
			array(2014, 6, 1,  0, 0, 0, new DateTime('2014-06-01 00:00:00')),
			array(2014, 1, 1,  0, 0, 0,	new DateTime('2014-01-01 00:00:00')),
		);
	}

	/**
	 * Test cases for createFromDate.
	 *
	 * @return array
	 */
	public static function createFromDateFactoryMethod()
	{
		return array(
			array(2014, 6, 12, new DateTime('2014-06-12 00:00:00')),
			array(2014, 6, 1,  new DateTime('2014-06-01 00:00:00')),
			array(2014, 1, 1,  new DateTime('2014-01-01 00:00:00')),
		);
	}

	/**
	 * Test cases for createFromTime.
	 *
	 * @return array
	 */
	public static function createFromTimeFactoryMethod()
	{
		return array(
			array(8, 4, 9, new DateTime(date('Y-m-d 08:04:09'))),
			array(8, 4, 0, new DateTime(date('Y-m-d 08:04:00'))),
			array(8, 0, 0, new DateTime(date('Y-m-d 08:00:00'))),
		);
	}

	/**
	 * Test cases for addDays.
	 *
	 * @return array
	 */
	public static function addDays()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, 1,  new DateTime('2014-07-02')),
			array($date1, -1, new DateTime('2014-06-30')),
			array($date2, 1,  new DateTime('2014-08-01')),
			array($date2, -1, new DateTime('2014-07-30')),
		);
	}

	/**
	 * Test cases for subDays.
	 *
	 * @return array
	 */
	public static function subDays()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, 1,  new DateTime('2014-06-30')),
			array($date1, -1, new DateTime('2014-07-02')),
			array($date2, 1,  new DateTime('2014-07-30')),
			array($date2, -1, new DateTime('2014-08-01')),
		);
	}

	/**
	 * Test cases for addWeeks.
	 *
	 * @return array
	 */
	public static function addWeeks()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, 1,  new DateTime('2014-07-08')),
			array($date1, -1, new DateTime('2014-06-24')),
			array($date2, 1,  new DateTime('2014-08-07')),
			array($date2, -1, new DateTime('2014-07-24')),
		);
	}

	/**
	 * Test cases for subWeeks.
	 *
	 * @return array
	 */
	public static function subWeeks()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, 1,  new DateTime('2014-06-24')),
			array($date1, -1, new DateTime('2014-07-08')),
			array($date2, 1,  new DateTime('2014-07-24')),
			array($date2, -1, new DateTime('2014-08-07')),
		);
	}

	/**
	 * Test cases for addMonths.
	 *
	 * @return array
	 */
	public static function addMonths()
	{
		$date1 = new DateTime('2014-08-01');
		$date2 = new DateTime('2014-08-31');
		$date3 = new DateTime('2014-12-01');
		$date4 = new DateTime('2014-12-31');
		$date5 = new DateTime('2014-01-31');

		return array(
			array($date1, 1,  new DateTime('2014-09-01')),
			array($date1, -1, new DateTime('2014-07-01')),
			array($date2, 1,  new DateTime('2014-09-30')),
			array($date2, -1, new DateTime('2014-07-31')),
			array($date3, 1,  new DateTime('2015-01-01')),
			array($date3, -1, new DateTime('2014-11-01')),
			array($date4, 1,  new DateTime('2015-01-31')),
			array($date4, -1, new DateTime('2014-11-30')),
			array($date5, 1,  new DateTime('2014-02-28')),
			array($date5, -1, new DateTime('2013-12-31')),
		);
	}

	/**
	 * Test cases for subMonths.
	 *
	 * @return array
	 */
	public static function subMonths()
	{
		$date1 = new DateTime('2014-08-01');
		$date2 = new DateTime('2014-08-31');
		$date3 = new DateTime('2014-12-01');
		$date4 = new DateTime('2014-12-31');
		$date5 = new DateTime('2014-01-31');

		return array(
			array($date1, 1,  new DateTime('2014-07-01')),
			array($date1, -1, new DateTime('2014-09-01')),
			array($date2, 1,  new DateTime('2014-07-31')),
			array($date2, -1, new DateTime('2014-09-30')),
			array($date3, 1,  new DateTime('2014-11-01')),
			array($date3, -1, new DateTime('2015-01-01')),
			array($date4, 1,  new DateTime('2014-11-30')),
			array($date4, -1, new DateTime('2015-01-31')),
			array($date5, 1,  new DateTime('2013-12-31')),
			array($date5, -1, new DateTime('2014-02-28')),
		);
	}

	/**
	 * Test cases for addYears.
	 *
	 * @return array
	 */
	public static function addYears()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2016-02-29');

		return array(
			array($date1, 1,  new DateTime('2015-07-01')),
			array($date1, -1, new DateTime('2013-07-01')),
			array($date2, 1,  new DateTime('2017-02-28')),
			array($date2, -1, new DateTime('2015-02-28')),
		);
	}

	/**
	 * Test cases for subYears.
	 *
	 * @return array
	 */
	public static function subYears()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2016-02-29');

		return array(
			array($date1, 1,  new DateTime('2013-07-01')),
			array($date1, -1, new DateTime('2015-07-01')),
			array($date2, 1,  new DateTime('2015-02-28')),
			array($date2, -1, new DateTime('2017-02-28')),
		);
	}

	/**
	 * Test cases for addSeconds.
	 *
	 * @return array
	 */
	public static function addSeconds()
	{
		$date1 = new DateTime('2014-07-10 23:59:59');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, 1,  new DateTime('2014-07-11 00:00:00')),
			array($date1, -1, new DateTime('2014-07-10 23:59:58')),
			array($date2, 1,  new DateTime('2014-07-10 00:00:01')),
			array($date2, -1, new DateTime('2014-07-09 23:59:59')),
		);
	}

	/**
	 * Test cases for subSeconds.
	 *
	 * @return array
	 */
	public static function subSeconds()
	{
		$date1 = new DateTime('2014-07-10 23:59:59');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, 1,  new DateTime('2014-07-10 23:59:58')),
			array($date1, -1, new DateTime('2014-07-11 00:00:00')),
			array($date2, 1,  new DateTime('2014-07-09 23:59:59')),
			array($date2, -1, new DateTime('2014-07-10 00:00:01')),
		);
	}

	/**
	 * Test cases for addMinutes.
	 *
	 * @return array
	 */
	public static function addMinutes()
	{
		$date1 = new DateTime('2014-07-10 23:59:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, 1,  new DateTime('2014-07-11 00:00:00')),
			array($date1, -1, new DateTime('2014-07-10 23:58:00')),
			array($date2, 1,  new DateTime('2014-07-10 00:01:00')),
			array($date2, -1, new DateTime('2014-07-09 23:59:00')),
		);
	}

	/**
	 * Test cases for subMinutes.
	 *
	 * @return array
	 */
	public static function subMinutes()
	{
		$date1 = new DateTime('2014-07-10 23:59:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, 1,  new DateTime('2014-07-10 23:58:00')),
			array($date1, -1, new DateTime('2014-07-11 00:00:00')),
			array($date2, 1,  new DateTime('2014-07-09 23:59:00')),
			array($date2, -1, new DateTime('2014-07-10 00:01:00')),
		);
	}

	/**
	 * Test cases for addHours.
	 *
	 * @return array
	 */
	public static function addHours()
	{
		$date1 = new DateTime('2014-07-10 23:00:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, 1,  new DateTime('2014-07-11 00:00:00')),
			array($date1, -1, new DateTime('2014-07-10 22:00:00')),
			array($date2, 1,  new DateTime('2014-07-10 01:00:00')),
			array($date2, -1, new DateTime('2014-07-09 23:00:00')),
		);
	}

	/**
	 * Test cases for subHours.
	 *
	 * @return array
	 */
	public static function subHours()
	{
		$date1 = new DateTime('2014-07-10 23:00:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, 1,  new DateTime('2014-07-10 22:00:00')),
			array($date1, -1, new DateTime('2014-07-11 00:00:00')),
			array($date2, 1,  new DateTime('2014-07-09 23:00:00')),
			array($date2, -1, new DateTime('2014-07-10 01:00:00')),
		);
	}

	/**
	 * Test cases for since.
	 *
	 * @return array
	 */
	public static function since()
	{
		$since = new DateTime('2014-06-30 12:00:00');
		$someDate = $since->subYears(1)->subMonths(1)->subWeeks(2)->subDays(4)->subHours(6)->subMinutes(15)->subSeconds(25);

		return array(
			/** $since is in the past */
			array(1, $since, $since, 'just now'),
			array(1, $since, $since->subSeconds(1),  'just now'),
			array(1, $since, $since->subSeconds(59), 'just now'),
			array(1, $since, $since->subMinutes(1),  '1 minute ago'),
			array(1, $since, $since->subMinutes(2),  '2 minutes ago'),
			array(1, $since, $since->subMinutes(59), '59 minutes ago'),
			array(1, $since, $since->subHours(1),    '1 hour ago'),
			array(1, $since, $since->subHours(2),    '2 hours ago'),
			array(1, $since, $since->subHours(23),   '23 hours ago'),
			array(1, $since, $since->subDays(1),     '1 day ago'),
			array(1, $since, $since->subDays(2),     '2 days ago'),
			array(1, $since, $since->subDays(6),     '6 days ago'),
			array(1, $since, $since->subWeeks(1),    '1 week ago'),
			array(1, $since, $since->subWeeks(2),    '2 weeks ago'),
			array(1, $since, $since->subWeeks(4),    '4 weeks ago'),
			array(1, $since, $since->subMonths(1),   '1 month ago'),
			array(1, $since, $since->subMonths(2),   '2 months ago'),
			array(1, $since, $since->subMonths(11),  '11 months ago'),
			array(1, $since, $since->subYears(1),    '1 year ago'),
			array(1, $since, $since->subYears(2),    '2 years ago'),
			/** $since is in the future */
			array(1, $since, $since->addSeconds(1),  'just now'),
			array(1, $since, $since->addSeconds(59), 'just now'),
			array(1, $since, $since->addMinutes(1),  'in 1 minute'),
			array(1, $since, $since->addMinutes(2),  'in 2 minutes'),
			array(1, $since, $since->addMinutes(59), 'in 59 minutes'),
			array(1, $since, $since->addHours(1),    'in 1 hour'),
			array(1, $since, $since->addHours(2),    'in 2 hours'),
			array(1, $since, $since->addHours(23),   'in 23 hours'),
			array(1, $since, $since->addDays(1),     'in 1 day'),
			array(1, $since, $since->addDays(2),     'in 2 days'),
			array(1, $since, $since->addDays(6),     'in 6 days'),
			array(1, $since, $since->addWeeks(1),    'in 1 week'),
			array(1, $since, $since->addWeeks(2),    'in 2 weeks'),
			array(1, $since, $since->addWeeks(4),    'in 4 weeks'),
			array(1, $since, $since->addMonths(1),   'in 1 month'),
			array(1, $since, $since->addMonths(2),   'in 2 months'),
			array(1, $since, $since->addMonths(11),  'in 11 months'),
			array(1, $since, $since->addYears(1),    'in 1 year'),
			array(1, $since, $since->addYears(2),    'in 2 years'),
			/** with differents detailLevels */
			array(1, $since, $since->addHours(30),   'in 1 day'),
			array(2, $since, $since->addHours(30),   'in 1 day and 6 hours'),
			array(3, $since, $since->addHours(30),   'in 1 day and 6 hours'),
			array(1, $since, $since->addMinutes(1830), 'in 1 day'),
			array(2, $since, $since->addMinutes(1830), 'in 1 day and 6 hours'),
			array(3, $since, $since->addMinutes(1830), 'in 1 day, 6 hours and 30 minutes'),
			array(4, $since, $since->addMinutes(1830), 'in 1 day, 6 hours and 30 minutes'),
			array(1, $since, $since->addSeconds(109830), 'in 1 day'),
			array(2, $since, $since->addSeconds(109830), 'in 1 day and 6 hours'),
			array(3, $since, $since->addSeconds(109830), 'in 1 day, 6 hours and 30 minutes'),
			array(4, $since, $since->addSeconds(109830), 'in 1 day, 6 hours, 30 minutes and 30 seconds'),
			array(5, $since, $since->addSeconds(109830), 'in 1 day, 6 hours, 30 minutes and 30 seconds'),
			/** the big one */
			array(1, $since, $someDate, '1 year ago'),
			array(2, $since, $someDate, '1 year and 1 month ago'),
			array(3, $since, $someDate, '1 year, 1 month and 2 weeks ago'),
			array(4, $since, $someDate, '1 year, 1 month, 2 weeks and 4 days ago'),
			array(5, $since, $someDate, '1 year, 1 month, 2 weeks, 4 days and 6 hours ago'),
			array(6, $since, $someDate, '1 year, 1 month, 2 weeks, 4 days, 6 hours and 15 minutes ago'),
			array(7, $since, $someDate, '1 year, 1 month, 2 weeks, 4 days, 6 hours, 15 minutes and 25 seconds ago'),
		);
	}

	/**
	 * Test cases for since in polish.
	 *
	 * @return array
	 */
	public static function since_pl()
	{
		$since = new DateTime('2014-06-30 12:00:00');
		$someDate = $since->subYears(1)->subMonths(1)->subWeeks(2)->subDays(4)->subHours(6)->subMinutes(15)->subSeconds(25);

		return array(
			/** $since is in the past */
			array(1, $since, $since, 'przed chwilą'),
			array(1, $since, $since->subSeconds(1),  'przed chwilą'),
			array(1, $since, $since->subSeconds(59), 'przed chwilą'),
			array(1, $since, $since->subMinutes(1),  '1 minutę temu'),
			array(1, $since, $since->subMinutes(2),  '2 minuty temu'),
			array(1, $since, $since->subMinutes(59), '59 minut temu'),
			array(1, $since, $since->subHours(1),    '1 godzinę temu'),
			array(1, $since, $since->subHours(2),    '2 godziny temu'),
			array(1, $since, $since->subHours(5),    '5 godzin temu'),
			array(1, $since, $since->subHours(23),   '23 godziny temu'),
			array(1, $since, $since->subDays(1),     '1 dzień temu'),
			array(1, $since, $since->subDays(2),     '2 dni temu'),
			array(1, $since, $since->subDays(5),     '5 dni temu'),
			array(1, $since, $since->subWeeks(1),    '1 tydzień temu'),
			array(1, $since, $since->subWeeks(2),    '2 tygodnie temu'),
			array(1, $since, $since->subWeeks(4),    '4 tygodnie temu'),
			array(1, $since, $since->subMonths(1),   '1 miesiąc temu'),
			array(1, $since, $since->subMonths(2),   '2 miesiące temu'),
			array(1, $since, $since->subMonths(11),  '11 miesięcy temu'),
			array(1, $since, $since->subYears(1),    '1 rok temu'),
			array(1, $since, $since->subYears(2),    '2 lata temu'),
			array(1, $since, $since->subYears(5),    '5 lat temu'),
			/** $since is in the future */
			array(1, $since, $since->addSeconds(1),  'przed chwilą'),
			array(1, $since, $since->addSeconds(59), 'przed chwilą'),
			array(1, $since, $since->addMinutes(1),  'za 1 minutę'),
			array(1, $since, $since->addMinutes(2),  'za 2 minuty'),
			array(1, $since, $since->addMinutes(59), 'za 59 minut'),
			array(1, $since, $since->addHours(1),    'za 1 godzinę'),
			array(1, $since, $since->addHours(2),    'za 2 godziny'),
			array(1, $since, $since->addHours(5),    'za 5 godzin'),
			array(1, $since, $since->addHours(23),   'za 23 godziny'),
			array(1, $since, $since->addDays(1),     'za 1 dzień'),
			array(1, $since, $since->addDays(2),     'za 2 dni'),
			array(1, $since, $since->addDays(5),     'za 5 dni'),
			array(1, $since, $since->addWeeks(1),    'za 1 tydzień'),
			array(1, $since, $since->addWeeks(2),    'za 2 tygodnie'),
			array(1, $since, $since->addWeeks(4),    'za 4 tygodnie'),
			array(1, $since, $since->addMonths(1),   'za 1 miesiąc'),
			array(1, $since, $since->addMonths(2),   'za 2 miesiące'),
			array(1, $since, $since->addMonths(11),  'za 11 miesięcy'),
			array(1, $since, $since->addYears(1),    'za 1 rok'),
			array(1, $since, $since->addYears(2),    'za 2 lata'),
			array(1, $since, $since->addYears(5),    'za 5 lat'),
			/** with differents detailLevels */
			array(1, $since, $since->addHours(30),   'za 1 dzień'),
			array(2, $since, $since->addHours(30),   'za 1 dzień i 6 godzin'),
			array(3, $since, $since->addHours(30),   'za 1 dzień i 6 godzin'),
			array(1, $since, $since->addMinutes(1830), 'za 1 dzień'),
			array(2, $since, $since->addMinutes(1830), 'za 1 dzień i 6 godzin'),
			array(3, $since, $since->addMinutes(1830), 'za 1 dzień, 6 godzin i 30 minut'),
			array(4, $since, $since->addMinutes(1830), 'za 1 dzień, 6 godzin i 30 minut'),
			array(1, $since, $since->addSeconds(109830), 'za 1 dzień'),
			array(2, $since, $since->addSeconds(109830), 'za 1 dzień i 6 godzin'),
			array(3, $since, $since->addSeconds(109830), 'za 1 dzień, 6 godzin i 30 minut'),
			array(4, $since, $since->addSeconds(109830), 'za 1 dzień, 6 godzin, 30 minut i 30 sekund'),
			array(5, $since, $since->addSeconds(109830), 'za 1 dzień, 6 godzin, 30 minut i 30 sekund'),
			/** the big one */
			array(1, $since, $someDate, '1 rok temu'),
			array(2, $since, $someDate, '1 rok i 1 miesiąc temu'),
			array(3, $since, $someDate, '1 rok, 1 miesiąc i 2 tygodnie temu'),
			array(4, $since, $someDate, '1 rok, 1 miesiąc, 2 tygodnie i 4 dni temu'),
			array(5, $since, $someDate, '1 rok, 1 miesiąc, 2 tygodnie, 4 dni i 6 godzin temu'),
			array(6, $since, $someDate, '1 rok, 1 miesiąc, 2 tygodnie, 4 dni, 6 godzin i 15 minut temu'),
			array(7, $since, $someDate, '1 rok, 1 miesiąc, 2 tygodnie, 4 dni, 6 godzin, 15 minut i 25 sekund temu'),
		);
	}

	/**
	 * Test cases for sinceAlmost.
	 *
	 * @return array
	 */
	public static function sinceAlmost()
	{
		$since = new DateTime('2014-06-30 12:00:00');

		return array(
			array($since, $since->subMinutes(51),	'almost 1 hour ago'),
			array($since, $since->subHours(21),		'almost 1 day ago'),
			array($since, $since->subHours(164),	'almost 1 week ago'),
			array($since, $since->subDays(28),		'almost 1 month ago'),
			array($since, $since->subMonths(11),	'almost 1 year ago'),
			array($since, $since->addMinutes(51),	'in almost 1 hour'),
			array($since, $since->addHours(21),		'in almost 1 day'),
			array($since, $since->addHours(164),	'in almost 1 week'),
			array($since, $since->addDays(28),		'in almost 1 month'),
			array($since, $since->addMonths(11),	'in almost 1 year'),
			array($since, $since->subYears(2),		'2 years ago')
		);
	}

	/**
	 * Test cases for sinceAlmost in polish.
	 *
	 * @return array
	 */
	public static function sinceAlmost_pl()
	{
		$since = new DateTime('2014-06-30 12:00:00');

		return array(
			array($since, $since->subMinutes(51),	'prawie 1 godzinę temu'),
			array($since, $since->subHours(21),		'prawie 1 dzień temu'),
			array($since, $since->subHours(164),	'prawie 1 tydzień temu'),
			array($since, $since->subDays(28),		'prawie 1 miesiąc temu'),
			array($since, $since->subMonths(11),	'prawie 1 rok temu'),
			array($since, $since->addMinutes(51),	'za prawie 1 godzinę'),
			array($since, $since->addHours(21),		'za prawie 1 dzień'),
			array($since, $since->addHours(164),	'za prawie 1 tydzień'),
			array($since, $since->addDays(28),		'za prawie 1 miesiąc'),
			array($since, $since->addMonths(11),	'za prawie 1 rok')
		);
	}

	/**
	 * Test cases for __get.
	 *
	 * @return array
	 */
	public static function DateTimeGetter()
	{
		$datetime = new DateTime("2014-05-25 12:27:39");
		$leapyear = new DateTime("2016-05-02");

		return array(
			array($datetime, 'daysinmonth', 31),
			array($datetime, 'dayofweek', 7),
			array($datetime, 'dayofyear', 144),
			array($datetime, 'isleapyear', false),
			array($leapyear, 'isleapyear', true),
			array($datetime, 'day', 25),
			array($datetime, 'hour', 12),
			array($datetime, 'minute', 27),
			array($datetime, 'second', 39),
			array($datetime, 'month', 5),
			array($datetime, 'ordinal', 'th'),
			array($leapyear, 'ordinal', 'nd'),
			array($datetime, 'week', 21),
			array($datetime, 'year', 2014),
		);
	}

	/**
	 * Test cases for __get.
	 *
	 * @return array
	 */
	public static function DummyGetter()
	{
		$datetime = new DateTime("2014-05-25 12:27:39");

		return array_merge(
			static::DateTimeGetter(),
			array(
				array($datetime, 'test', 'It works!')
			)
		);
	}

	/**
	 * Test cases for parse.
	 *
	 * @return array
	 */
	public static function DummyParser()
	{
		return array(
			array('fromString', '2014-08-24 12:30:20', new DateTime('2014-08-24 12:30:20')),
			array('fromDate', new \Joomla\DateTime\Date('2014-08-24'), new DateTime('2014-08-24')),
			array('fromPHPDateTime', new \DateTime('2014-08-24'), new DateTime('2014-08-24'))
		);
	}
}
