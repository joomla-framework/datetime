<?php

namespace Joomla\DateTime\Fixture;

use Joomla\DateTime\DateTime;
use Joomla\DateTime\Wrapper\Wrapper;

final class DummyWrapper implements Wrapper
{
	/** @var Wrapper */
	private $wrapper;

	public function __construct(Wrapper $wrapper)
	{
		$this->wrapper = $wrapper;
	}

	public function get(DateTime $datetime, $name)
	{
		$value = null;

		switch($name) {
			case 'test':
				$value = 'It works!';
				break;

			default:
				$value = $this->wrapper->get($datetime, $name);
		}

		return $value;
	}
}
