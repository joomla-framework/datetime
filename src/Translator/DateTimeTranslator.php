<?php

/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Translator;

use Symfony\Component\Translation\MessageSelector;

/**
 * Default implemenation of Translator.
 *
 * @since  2.0
 */
final class DateTimeTranslator extends Translator
{
	/** @var MessageSelector */
	private $selector;

	/** @var  array */
	private $loaded = array();

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->selector = new MessageSelector;
	}

	/**
	 * Returns a translated item.
	 *
	 * @param   string  $item     The item to translate.
	 * @param   array   $replace  An replace array.
	 *
	 * @return string
	 */
	public function get($item, array $replace = array())
	{
		$this->load();

		if (!isset($this->loaded[$this->locale][$item]))
		{
			return $item;
		}

		$line = $this->loaded[$this->locale][$item];

		return $this->makeReplacements($line, $replace);
	}

	/**
	 * Returns a translated item with a proper form for pluralization.
	 *
	 * @param   string   $item     The item to translate.
	 * @param   integer  $number   Number of items for pluralization.
	 * @param   array    $replace  An replace array.
	 *
	 * @return string
	 */
	public function choice($item, $number, array $replace = array())
	{
		$lines = $this->get($item, $replace);

		$replace['count'] = $number;

		return $this->makeReplacements($this->selector->choose($lines, $number, $this->locale), $replace);
	}

	/**
	 * Loads dictionary.
	 *
	 * @return void
	 */
	private function load()
	{
		if ($this->isLoaded())
		{
			return;
		}

		$path = sprintf('%s/../../lang/%s.php', __DIR__, $this->locale);

		if (file_exists($path))
		{
			$this->loaded[$this->locale] = require $path;
		}
	}

	/**
	 * Checks if a dictionary for the current locale is loaded.
	 *
	 * @return void
	 */
	private function isLoaded()
	{
		return isset($this->loaded[$this->locale]);
	}

	/**
	 * Makes replacements.
	 *
	 * @param   string  $line     The original line.
	 * @param   array   $replace  An replace array.
	 *
	 * @return string
	 */
	private function makeReplacements($line, array $replace)
	{
		foreach ($replace as $key => $value)
		{
			$line = str_replace(':' . $key, $value, $line);
		}

		return $line;
	}
}
