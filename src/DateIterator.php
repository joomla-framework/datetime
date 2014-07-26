<?php

namespace Joomla\DateTime;

class DateIterator extends DateTimeIterator
{
	public function __construct(Date $start, Date $end)
	{
		parent::__construct(new DateTime($start), new DateTime($end), new \DateInterval('P1D'));
	}

	public function current()
	{
		return new Date(parent::current());
	}
}
