<?php

namespace Joomla\DateTime\Wrapper;

use Joomla\DateTime\DateTime;

interface Wrapper
{
	public function get(DateTime $datetime, $name);
}
