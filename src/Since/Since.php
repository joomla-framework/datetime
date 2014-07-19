<?php

namespace Joomla\DateTime\Since;

use Joomla\DateTime\DateTime;

interface Since
{
	public function since(DateTime $base, DateTime $datetime, $detailLevel);
	public function almost(DateTime $base, DateTime $datetime);
}
