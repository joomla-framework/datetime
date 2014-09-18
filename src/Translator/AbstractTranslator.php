<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 2.1 or later; see LICENSE
 */

namespace Joomla\DateTime\Translator;

/**
 * Base Translator class.
 *
 * @since  2.0.0
 */
abstract class AbstractTranslator
{
	/**
	 * The locale to use.
	 *
	 * @var    string
	 * @since  2.0.0
	 */
	protected $locale = 'en';

	/**
	 * Sets the locale.
	 *
	 * @param   string  $locale  The locale to set.
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function setLocale($locale)
	{
		$this->locale = $locale;
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
	abstract public function get($item, array $replace = array());

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
	abstract public function choice($item, $number, array $replace = array());
}
