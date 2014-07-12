<?php

namespace Joomla\DateTime\Fixture;

use Joomla\DateTime\DateTime;

final class DateTimeTestProvider
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

	public static function addDays(DateTime $sut)
	{
		return array(
			array($sut, $sut->addDays(1), $sut->add(new \DateInterval('P1D'))),
			array($sut, $sut->addDays(-1), $sut->sub(new \DateInterval('P1D'))),

			array($sut, $sut->beginOfDay(), new DateTime($sut->format('Y-m-d 00:00:00'))),
			array($sut, $sut->endOfDay(), new DateTime($sut->format('Y-m-d 23:59:59'))),
			array($sut, $sut->beginOfWeek(), new DateTime('2014-05-19 00:00:00')),
			array($sut, $sut->endOfWeek(), new DateTime('2014-05-25 23:59:59')),
			array($sut, $sut->beginOfMonth(), new DateTime($sut->format('Y-m-01 00:00:00'))),
			array($sut, $sut->endOfMonth(), new DateTime($sut->format('Y-m-31 23:59:59'))),
			array($sut, $sut->beginOfYear(), new DateTime($sut->format('Y-01-01 00:00:00'))),
			array($sut, $sut->endOfYear(), new DateTime($sut->format('Y-12-31 23:59:59')))
		);
	}

	public static function subDays(DateTime $sut)
	{
		return array(
			array($sut, $sut->subDays(1), $sut->sub(new \DateInterval('P1D'))),
			array($sut, $sut->subDays(-1), $sut->add(new \DateInterval('P1D'))),
		);
	}

	public static function addWeeks(DateTime $sut)
	{
		return array(
			array($sut, $sut->addWeeks(1), $sut->add(new \DateInterval('P1W'))),
			array($sut, $sut->addWeeks(-1), $sut->sub(new \DateInterval('P1W'))),
		);
	}

	public static function subWeeks(DateTime $sut)
	{
		return array(
			array($sut, $sut->subWeeks(1), $sut->sub(new \DateInterval('P1W'))),
			array($sut, $sut->subWeeks(-1), $sut->add(new \DateInterval('P1W'))),
		);
	}

	public static function addMonths(DateTime $sut)
	{
		return array(
			array($sut, $sut->addMonths(1), $sut->add(new \DateInterval('P1M'))),
			array($sut, $sut->addMonths(-1), $sut->sub(new \DateInterval('P1M'))),
		);
	}

	public static function subMonths(DateTime $sut)
	{
		return array(
			array($sut, $sut->subMonths(1), $sut->sub(new \DateInterval('P1M'))),
			array($sut, $sut->subMonths(-1), $sut->add(new \DateInterval('P1M'))),
		);
	}

	public static function addYears(DateTime $sut)
	{
		return array(
			array($sut, $sut->addYears(1), $sut->add(new \DateInterval('P1Y'))),
			array($sut, $sut->addYears(-1), $sut->sub(new \DateInterval('P1Y'))),
		);
	}

	public static function subYears(DateTime $sut)
	{
		return array(
			array($sut, $sut->subYears(1), $sut->sub(new \DateInterval('P1Y'))),
			array($sut, $sut->subYears(-1), $sut->add(new \DateInterval('P1Y'))),
		);
	}

	public static function addSeconds(DateTime $sut)
	{
		return array(
			array($sut, $sut->addSeconds(1), $sut->add(new \DateInterval('PT1S'))),
			array($sut, $sut->addSeconds(-1), $sut->sub(new \DateInterval('PT1S'))),
		);
	}

	public static function subSeconds(DateTime $sut)
	{
		return array(
			array($sut, $sut->subSeconds(1), $sut->sub(new \DateInterval('PT1S'))),
			array($sut, $sut->subSeconds(-1), $sut->add(new \DateInterval('PT1S'))),
		);
	}

	public static function addMinutes(DateTime $sut)
	{
		return array(
			array($sut, $sut->addMinutes(1), $sut->add(new \DateInterval('PT1M'))),
			array($sut, $sut->addMinutes(-1), $sut->sub(new \DateInterval('PT1M'))),
		);
	}

	public static function subMinutes(DateTime $sut)
	{
		return array(
			array($sut, $sut->subMinutes(1), $sut->sub(new \DateInterval('PT1M'))),
			array($sut, $sut->subMinutes(-1), $sut->add(new \DateInterval('PT1M'))),
		);
	}

	public static function addHours(DateTime $sut)
	{
		return array(
			array($sut, $sut->subHours(1), $sut->sub(new \DateInterval('PT1H'))),
			array($sut, $sut->subHours(-1), $sut->add(new \DateInterval('PT1H'))),
		);
	}

	public static function subHours(DateTime $sut)
	{
		return array(
			array($sut, $sut->addHours(1), $sut->add(new \DateInterval('PT1H'))),
			array($sut, $sut->addHours(-1), $sut->sub(new \DateInterval('PT1H'))),
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
