<?php

namespace Joomla\DateTime\Fixture;

use Joomla\DateTime\DateTime;
use Joomla\DateTime\Getter\Getter;

final class DummyGetter implements Getter
{
	/** @var Getter */
	private $getter;

	public function __construct(Getter $getter)
	{
		$this->getter = $getter;
	}

	public function get(DateTime $datetime, $name)
	{
		$value = null;

		switch($name) {
			case 'test':
				$value = 'It works!';
				break;

			default:
				$value = $this->getter->get($datetime, $name);
		}

		return $value;
	}
}
