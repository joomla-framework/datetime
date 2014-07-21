<?php

namespace Joomla\DateTime\Strategy;

class DateTimeStrategy implements Strategy
{
	public function startOfDay(\DateTime $datetime)
	{
		$datetime->setTime(0, 0, 0);
	}

	public function endOfDay(\DateTime $datetime)
	{
		$datetime->setTime(23, 59, 59);
	}

	public function startOfWeek(\DateTime $datetime)
	{
		$diffInDays = intval($datetime->format('N')) - 1;
		$intervalSpec = sprintf('P%sD', $diffInDays);

		$datetime->sub(new \DateInterval($intervalSpec));
	}

	public function endOfWeek(\DateTime $datetime)
	{
		$diffInDays = 7 - intval($datetime->format('N'));
		$intervalSpec = sprintf('P%sD', $diffInDays);

		$datetime->add(new \DateInterval($intervalSpec));
	}

	public function startOfMonth(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$month = $datetime->format('m');

		$datetime->setDate($year, $month, 1);
	}

	public function endOfMonth(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$month = $datetime->format('m');
		$day = $datetime->format('t');

		$datetime->setDate($year, $month, $day);
	}

	public function startOfYear(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$datetime->setDate($year, 1, 1);
	}

	public function endOfYear(\DateTime $datetime)
	{
		$year = $datetime->format('Y');
		$datetime->setDate($year, 12, 31);
	}
}
