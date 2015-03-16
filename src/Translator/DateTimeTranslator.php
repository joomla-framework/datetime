<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Translator;

use Symfony\Component\Translation\MessageSelector;

/**
 * Default implementation of AbstractTranslator.
 *
 * @since  2.0.0
 */
final class DateTimeTranslator extends AbstractTranslator
{
	/**
	 * @var    MessageSelector
	 * @since  2.0.0
	 */
	private $selector;

	/**
	 * @var  array
	 * @since  2.0.0
	 */
	private $loaded = array();

	/**
	 * Constructor.
	 *
	 * @since   2.0.0
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
	 * @return  string
	 *
	 * @since   2.0.0
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
	 * @return  string
	 *
	 * @since   2.0.0
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
	 * @return  void
	 *
	 * @since   2.0.0
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
	 * @return  boolean
	 *
	 * @since   2.0.0
	 */
	private function isLoaded()
	{
		return isset($this->loaded[$this->locale]);
	}

	/**
	 * Replaces elements in a line.
	 *
	 * @param   string  $line     The original line.
	 * @param   array   $replace  An replace array.
	 *
	 * @return  string
	 *
	 * @since   2.0.0
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
