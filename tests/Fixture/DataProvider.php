<?php

namespace Joomla\DateTime\Fixture;

use Joomla\DateTime\DateTime;

final class DataProvider
{
	public static function createFactoryMethod()
	{
		return array(
			array(DateTime::create('2014', '06', '12', '08', '04', '09'), new DateTime('2014-06-12 08:04:09')),
			array(DateTime::create(2014, 6, 12, 8, 4, 9),	new DateTime('2014-06-12 08:04:09')),
			array(DateTime::create(2014, 6, 12, 8, 4),		new DateTime('2014-06-12 08:04:00')),
			array(DateTime::create(2014, 6, 12, 8),			new DateTime('2014-06-12 08:00:00')),
			array(DateTime::create(2014, 6, 12),			new DateTime('2014-06-12 00:00:00')),
			array(DateTime::create(2014, 6),				new DateTime('2014-06-01 00:00:00')),
			array(DateTime::create(2014),					new DateTime('2014-01-01 00:00:00')),
		);
	}

	public static function createFromDateFactoryMethod()
	{
		return array(
			array(DateTime::createFromDate(2014, 6, 12),	new DateTime('2014-06-12 00:00:00')),
			array(DateTime::createFromDate(2014, 6),		new DateTime('2014-06-01 00:00:00')),
			array(DateTime::createFromDate(2014),			new DateTime('2014-01-01 00:00:00')),
		);
	}

	public static function createFromTimeFactoryMethod()
	{
		return array(
			array(DateTime::createFromTime(8, 4, 9),		new DateTime(sprintf('%s 08:04:09', date('Y-m-d')))),
			array(DateTime::createFromTime(8, 4),			new DateTime(sprintf('%s 08:04:00', date('Y-m-d')))),
			array(DateTime::createFromTime(8),				new DateTime(sprintf('%s 08:00:00', date('Y-m-d')))),
		);
	}

	public static function addDays()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, $date1->addDays(1),  new DateTime('2014-07-02')),
			array($date1, $date1->addDays(-1), new DateTime('2014-06-30')),
			array($date2, $date2->addDays(1),  new DateTime('2014-08-01')),
			array($date2, $date2->addDays(-1), new DateTime('2014-07-30')),
		);
	}

	public static function subDays()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, $date1->subDays(1),  new DateTime('2014-06-30')),
			array($date1, $date1->subDays(-1), new DateTime('2014-07-02')),
			array($date2, $date2->subDays(1),  new DateTime('2014-07-30')),
			array($date2, $date2->subDays(-1), new DateTime('2014-08-01')),
		);
	}

	public static function addWeeks()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, $date1->addWeeks(1),  new DateTime('2014-07-08')),
			array($date1, $date1->addWeeks(-1), new DateTime('2014-06-24')),
			array($date2, $date2->addWeeks(1),  new DateTime('2014-08-07')),
			array($date2, $date2->addWeeks(-1), new DateTime('2014-07-24')),
		);
	}

	public static function subWeeks()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2014-07-31');

		return array(
			array($date1, $date1->subWeeks(1),  new DateTime('2014-06-24')),
			array($date1, $date1->subWeeks(-1), new DateTime('2014-07-08')),
			array($date2, $date2->subWeeks(1),  new DateTime('2014-07-24')),
			array($date2, $date2->subWeeks(-1), new DateTime('2014-08-07')),
		);
	}

	public static function addMonths()
	{
		$date1 = new DateTime('2014-08-01');
		$date2 = new DateTime('2014-08-31');
		$date3 = new DateTime('2014-12-01');
		$date4 = new DateTime('2014-12-31');
		$date5 = new DateTime('2014-01-31');

		return array(
			array($date1, $date1->addMonths(1),  new DateTime('2014-09-01')),
			array($date1, $date1->addMonths(-1), new DateTime('2014-07-01')),
			array($date2, $date2->addMonths(1),  new DateTime('2014-10-01')), // @todo check!
			array($date2, $date2->addMonths(-1), new DateTime('2014-07-31')),
			array($date3, $date3->addMonths(1),  new DateTime('2015-01-01')),
			array($date3, $date3->addMonths(-1), new DateTime('2014-11-01')),
			array($date4, $date4->addMonths(1),  new DateTime('2015-01-31')),
			array($date4, $date4->addMonths(-1), new DateTime('2014-12-01')),  // @todo check!
			array($date5, $date5->addMonths(1),  new DateTime('2014-03-03')),  // @todo check!
			array($date5, $date5->addMonths(-1), new DateTime('2013-12-31')),
		);
	}

	public static function subMonths()
	{
		$date1 = new DateTime('2014-08-01');
		$date2 = new DateTime('2014-08-31');
		$date3 = new DateTime('2014-12-01');
		$date4 = new DateTime('2014-12-31');
		$date5 = new DateTime('2014-01-31');

		return array(
			array($date1, $date1->subMonths(1),  new DateTime('2014-07-01')),
			array($date1, $date1->subMonths(-1), new DateTime('2014-09-01')),
			array($date2, $date2->subMonths(1),  new DateTime('2014-07-31')),
			array($date2, $date2->subMonths(-1), new DateTime('2014-10-01')), // @todo check!
			array($date3, $date3->subMonths(1),  new DateTime('2014-11-01')),
			array($date3, $date3->subMonths(-1), new DateTime('2015-01-01')),
			array($date4, $date4->subMonths(1),  new DateTime('2014-12-01')), // @todo check!
			array($date4, $date4->subMonths(-1), new DateTime('2015-01-31')),
			array($date5, $date5->subMonths(1),  new DateTime('2013-12-31')),
			array($date5, $date5->subMonths(-1), new DateTime('2014-03-03')), // @todo check!
		);
	}

	public static function addYears()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2016-02-29');

		return array(
			array($date1, $date1->addYears(1),  new DateTime('2015-07-01')),
			array($date1, $date1->addYears(-1), new DateTime('2013-07-01')),
			array($date2, $date2->addYears(1),  new DateTime('2017-03-01')), // @todo check!
			array($date2, $date2->addYears(-1), new DateTime('2015-03-01')), // @todo check!
		);
	}

	public static function subYears()
	{
		$date1 = new DateTime('2014-07-01');
		$date2 = new DateTime('2016-02-29');

		return array(
			array($date1, $date1->subYears(1),  new DateTime('2013-07-01')),
			array($date1, $date1->subYears(-1), new DateTime('2015-07-01')),
			array($date2, $date2->subYears(1),  new DateTime('2015-03-01')), // @todo check!
			array($date2, $date2->subYears(-1), new DateTime('2017-03-01')), // @todo check!
		);
	}

	public static function addSeconds()
	{
		$date1 = new DateTime('2014-07-10 23:59:59');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, $date1->addSeconds(1),  new DateTime('2014-07-11 00:00:00')),
			array($date1, $date1->addSeconds(-1), new DateTime('2014-07-10 23:59:58')),
			array($date2, $date2->addSeconds(1),  new DateTime('2014-07-10 00:00:01')),
			array($date2, $date2->addSeconds(-1), new DateTime('2014-07-09 23:59:59')),
		);
	}

	public static function subSeconds()
	{
		$date1 = new DateTime('2014-07-10 23:59:59');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, $date1->subSeconds(1),  new DateTime('2014-07-10 23:59:58')),
			array($date1, $date1->subSeconds(-1), new DateTime('2014-07-11 00:00:00')),
			array($date2, $date2->subSeconds(1),  new DateTime('2014-07-09 23:59:59')),
			array($date2, $date2->subSeconds(-1), new DateTime('2014-07-10 00:00:01')),
		);
	}

	public static function addMinutes()
	{
		$date1 = new DateTime('2014-07-10 23:59:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, $date1->addMinutes(1),  new DateTime('2014-07-11 00:00:00')),
			array($date1, $date1->addMinutes(-1), new DateTime('2014-07-10 23:58:00')),
			array($date2, $date2->addMinutes(1),  new DateTime('2014-07-10 00:01:00')),
			array($date2, $date2->addMinutes(-1), new DateTime('2014-07-09 23:59:00')),
		);
	}

	public static function subMinutes()
	{
		$date1 = new DateTime('2014-07-10 23:59:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, $date1->subMinutes(1),  new DateTime('2014-07-10 23:58:00')),
			array($date1, $date1->subMinutes(-1), new DateTime('2014-07-11 00:00:00')),
			array($date2, $date2->subMinutes(1),  new DateTime('2014-07-09 23:59:00')),
			array($date2, $date2->subMinutes(-1), new DateTime('2014-07-10 00:01:00')),
		);
	}

	public static function addHours()
	{
		$date1 = new DateTime('2014-07-10 23:00:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, $date1->addHours(1),  new DateTime('2014-07-11 00:00:00')),
			array($date1, $date1->addHours(-1), new DateTime('2014-07-10 22:00:00')),
			array($date2, $date2->addHours(1),  new DateTime('2014-07-10 01:00:00')),
			array($date2, $date2->addHours(-1), new DateTime('2014-07-09 23:00:00')),
		);
	}

	public static function subHours()
	{
		$date1 = new DateTime('2014-07-10 23:00:00');
		$date2 = new DateTime('2014-07-10 00:00:00');

		return array(
			array($date1, $date1->subHours(1),  new DateTime('2014-07-10 22:00:00')),
			array($date1, $date1->subHours(-1), new DateTime('2014-07-11 00:00:00')),
			array($date2, $date2->subHours(1),  new DateTime('2014-07-09 23:00:00')),
			array($date2, $date2->subHours(-1), new DateTime('2014-07-10 01:00:00')),
		);
	}

	public static function timeSince()
	{
		$since = new DateTime('2014-06-30 12:00:00');
		$someDate = $since->subYears(1)->subMonths(1)->subWeeks(2)->subDays(4)->subHours(6)->subMinutes(15)->subSeconds(25);

		return array(
			/** $since is in the past */
			array(false, 1, $since, $since, 'just now'),
			array(false, 1, $since, $since->subSeconds(1),  'just now'),
			array(false, 1, $since, $since->subSeconds(59), 'just now'),
			array(false, 1, $since, $since->subMinutes(1),  '1 minute ago'),
			array(false, 1, $since, $since->subMinutes(2),  '2 minutes ago'),
			array(false, 1, $since, $since->subMinutes(59), '59 minutes ago'),
			array(false, 1, $since, $since->subHours(1),    '1 hour ago'),
			array(false, 1, $since, $since->subHours(2),    '2 hours ago'),
			array(false, 1, $since, $since->subHours(23),   '23 hours ago'),
			array(false, 1, $since, $since->subDays(1),     '1 day ago'),
			array(false, 1, $since, $since->subDays(2),     '2 days ago'),
			array(false, 1, $since, $since->subDays(6),     '6 days ago'),
			array(false, 1, $since, $since->subWeeks(1),    '1 week ago'),
			array(false, 1, $since, $since->subWeeks(2),    '2 weeks ago'),
			array(false, 1, $since, $since->subWeeks(4),    '4 weeks ago'),
			array(false, 1, $since, $since->subMonths(1),   '1 month ago'),
			array(false, 1, $since, $since->subMonths(2),   '2 months ago'),
			array(false, 1, $since, $since->subMonths(11),  '11 months ago'),
			array(false, 1, $since, $since->subYears(1),    '1 year ago'),
			array(false, 1, $since, $since->subYears(2),    '2 years ago'),
			/** $since is in the future */
			array(false, 1, $since, $since->addSeconds(1),  'just now'),
			array(false, 1, $since, $since->addSeconds(59), 'just now'),
			array(false, 1, $since, $since->addMinutes(1),  'in 1 minute'),
			array(false, 1, $since, $since->addMinutes(2),  'in 2 minutes'),
			array(false, 1, $since, $since->addMinutes(59), 'in 59 minutes'),
			array(false, 1, $since, $since->addHours(1),    'in 1 hour'),
			array(false, 1, $since, $since->addHours(2),    'in 2 hours'),
			array(false, 1, $since, $since->addHours(23),   'in 23 hours'),
			array(false, 1, $since, $since->addDays(1),     'in 1 day'),
			array(false, 1, $since, $since->addDays(2),     'in 2 days'),
			array(false, 1, $since, $since->addDays(6),     'in 6 days'),
			array(false, 1, $since, $since->addWeeks(1),    'in 1 week'),
			array(false, 1, $since, $since->addWeeks(2),    'in 2 weeks'),
			array(false, 1, $since, $since->addWeeks(4),    'in 4 weeks'),
			array(false, 1, $since, $since->addMonths(1),   'in 1 month'),
			array(false, 1, $since, $since->addMonths(2),   'in 2 months'),
			array(false, 1, $since, $since->addMonths(11),  'in 11 months'),
			array(false, 1, $since, $since->addYears(1),    'in 1 year'),
			array(false, 1, $since, $since->addYears(2),    'in 2 years'),
			/** with differents detailLevels */
			array(false, 1, $since, $since->addHours(30),   'in 1 day'),
			array(false, 2, $since, $since->addHours(30),   'in 1 day and 6 hours'),
			array(false, 3, $since, $since->addHours(30),   'in 1 day and 6 hours'),
			array(false, 1, $since, $since->addMinutes(1830), 'in 1 day'),
			array(false, 2, $since, $since->addMinutes(1830), 'in 1 day and 6 hours'),
			array(false, 3, $since, $since->addMinutes(1830), 'in 1 day, 6 hours and 30 minutes'),
			array(false, 4, $since, $since->addMinutes(1830), 'in 1 day, 6 hours and 30 minutes'),
			array(false, 1, $since, $since->addSeconds(109830), 'in 1 day'),
			array(false, 2, $since, $since->addSeconds(109830), 'in 1 day and 6 hours'),
			array(false, 3, $since, $since->addSeconds(109830), 'in 1 day, 6 hours and 30 minutes'),
			array(false, 4, $since, $since->addSeconds(109830), 'in 1 day, 6 hours, 30 minutes and 30 seconds'),
			array(false, 5, $since, $since->addSeconds(109830), 'in 1 day, 6 hours, 30 minutes and 30 seconds'),
			/** the big one */
			array(false, 1, $since, $someDate, '1 year ago'),
			array(false, 2, $since, $someDate, '1 year and 1 month ago'),
			array(false, 3, $since, $someDate, '1 year, 1 month and 2 weeks ago'),
			array(false, 4, $since, $someDate, '1 year, 1 month, 2 weeks and 4 days ago'),
			array(false, 5, $since, $someDate, '1 year, 1 month, 2 weeks, 4 days and 6 hours ago'),
			array(false, 6, $since, $someDate, '1 year, 1 month, 2 weeks, 4 days, 6 hours and 15 minutes ago'),
			array(false, 7, $since, $someDate, '1 year, 1 month, 2 weeks, 4 days, 6 hours, 15 minutes and 25 seconds ago'),
			/** with allowAlmost = true */
			array(true, 1, $since, $since->subMinutes(51),	'almost 1 hour ago'),
			array(true, 1, $since, $since->subHours(21),	'almost 1 day ago'),
			array(true, 1, $since, $since->subHours(164),	'almost 1 week ago'),
			array(true, 1, $since, $since->subMonths(11),	'almost 1 year ago')
		);
	}

}
