<?php

namespace Joomla\DateTime\Translator;

final class DateTimeTranslator extends Translator
{
    /** @var Symfony\MessageSelector */
	private $selector;

	/** @var  array */
	private $loaded = array();

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

	public function setSelector(Symfony\MessageSelector $selector)
    {
        $this->selector = $selector;
    }

	private function load()
    {
        if($this->isLoaded()) return;

        $path = sprintf('%s/lang/%s.php', __DIR__, $this->locale);

        if(file_exists($path)) {
			$this->loaded[$this->locale] = require $path;
        }
    }

    private function isLoaded()
    {
        return isset($this->loaded[$this->locale]);
    }

    private function makeReplacements($line, array $replace)
    {
		foreach ($replace as $key => $value) {
			//var_dump($value);
            $line = str_replace(':' . $key, $value, $line);
        }

        return $line;
    }

    /**
     * @return Symfony\MessageSelector
     */
    private function getSelector()
    {
        if(is_null($this->selector))
        {
            $this->selector = new Symfony\MessageSelector();
        }

        return $this->selector;
    }
}
