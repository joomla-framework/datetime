<?php

namespace Joomla\DateTime\Translator;

abstract class Translator
{
	protected $locale = 'en';

	public function setLocale($locale) {
		$this->locale = $locale;
	}

	abstract public function get($item, array $replace);
    abstract public function choice($item, $number, array $replace);
}
