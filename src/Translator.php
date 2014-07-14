<?php

namespace Joomla\DateTime;

//use Symfony\Component\Translation\MessageSelector;

final class Translator
{
    protected $locale = 'en';

    protected $loaded = array();

    public function get($item, array $replace = array())
    {
        $this->load();

		if(!isset($this->loaded[$this->locale][$item])) {
			return $item;
		}

		$line = $this->loaded[$this->locale][$item];

        return $this->makeReplacements($line, $replace);
    }

    public function choice($item, $number, array $replace = array())
    {
        $lines = $this->get($item, $replace);

        $replace['count'] = $number;

        return $this->makeReplacements($this->getSelector()->choose($lines, $number, $this->locale), $replace);
    }

	public function load()
    {
        if($this->isLoaded()) return;

        $path = sprintf('%s/../lang/%s.php', __DIR__, $this->locale);

        if(file_exists($path)) {
			$this->loaded[$this->locale] = require $path;
        }
    }

	public function setLocale($locale)
    {
        $this->locale = $locale;
    }

	public function setSelector(MessageSelector $selector)
    {
        $this->selector = $selector;
    }

    private function isLoaded()
    {
        return isset($this->loaded[$this->locale]);
    }

    private function makeReplacements($line, array $replace)
    {
        foreach ($replace as $key => $value) {
            $line = str_replace(':' . $key, $value, $line);
        }

        return $line;
    }

    /**
     * @return \Symfony\Component\Translation\MessageSelector
     */
    private function getSelector()
    {
        if ( ! isset($this->selector))
        {
            $this->selector = new MessageSelector;
        }

        return $this->selector;
    }
}
