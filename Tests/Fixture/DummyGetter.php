<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Test\Fixture;

use Joomla\DateTime\DateTime;
use Joomla\DateTime\Getter\GetterInterface;

/**
 * DummyGetter.
 *
 * @since  2.0
 */
final class DummyGetter implements GetterInterface
{
	/** @var GetterInterface */
	private $getter;

	/**
	 * Constructor.
	 *
	 * @param   GetterInterface  $getter  The Getter implementation.
	 */
	public function __construct(GetterInterface $getter)
	{
		$this->getter = $getter;
	}

	/**
	 * Return a value of the property.
	 *
	 * @param   DateTime  $datetime  The DateTime object.
	 * @param   string    $name      The name of the property.
	 *
	 * @return string
	 */
	public function get(DateTime $datetime, $name)
	{
		$value = null;

		switch ($name)
		{
			case 'test':
				$value = 'It works!';
				break;

			default:
				$value = $this->getter->get($datetime, $name);
		}

		return $value;
	}
}
