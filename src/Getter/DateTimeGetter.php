<?php

namespace Joomla\DateTime\Getter;

use Joomla\DateTime\DateTime;

final class DateTimeGetter implements Getter
{
	public function get(DateTime $datetime, $name)
	{
		$value = null;

		switch($name) {
			case 'daysinmonth':
				$value = $datetime->format('t');
				break;

			case 'dayofweek':
				$value = $datetime->format('N');
				break;

			case 'dayofyear':
				$value = $datetime->format('z');
				break;

			case 'isleapyear':
				$value = (boolean) $datetime->format('L');
				break;

			case 'day':
				$value = $datetime->format('d');
				break;

			case 'hour':
				$value = $datetime->format('H');
				break;

			case 'minute':
				$value = $datetime->format('i');
				break;

			case 'second':
				$value = $datetime->format('s');
				break;

			case 'month':
				$value = $datetime->format('m');
				break;

			case 'ordinal':
				$value = $datetime->format('S');
				break;

			case 'week':
				$value = $datetime->format('W');
				break;

			case 'year':
				$value = $datetime->format('Y');
				break;

			default:
				$trace = debug_backtrace();
				trigger_error(
						'Undefined property: ' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE
				);
		}

		return $value;
	}
}
