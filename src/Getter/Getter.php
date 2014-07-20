<?php

namespace Joomla\DateTime\Getter;

use Joomla\DateTime\DateTime;

interface Getter
{
	public function get(DateTime $datetime, $name);
}
