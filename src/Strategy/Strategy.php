<?php

namespace Joomla\DateTime\Strategy;

interface Strategy
{
	public function startOfDay(\DateTime $datetime);

	public function endOfDay(\DateTime $datetime);

	public function startOfWeek(\DateTime $datetime);

	public function endOfWeek(\DateTime $datetime);

	public function startOfMonth(\DateTime $datetime);

	public function endOfMonth(\DateTime $datetime);

	public function startOfYear(\DateTime $datetime);

	public function endOfYear(\DateTime $datetime);
}
