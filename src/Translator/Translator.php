<?php
/**
 * Part of the Joomla Framework DateTime Package
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\DateTime\Translator;

/**
 * Base Translator class.
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class Translator
{
	/**
	 * The locale to use.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	protected $locale = 'en';

	/**
	 * Sets the locale.
	 *
	 * @param   string  $locale  The locale to set.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
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
	 * @since   __DEPLOY_VERSION__
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
	 * @since   __DEPLOY_VERSION__
	 */
	abstract public function choice($item, $number, array $replace = array());
}
