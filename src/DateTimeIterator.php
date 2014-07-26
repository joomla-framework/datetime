<?php

namespace Joomla\DateTime;

class DateTimeIterator implements \Iterator
{
	/** @var DateTime */
	private $start;

	/** @var DateTime */
	private $end;

	/** @var \DateInterval */
	private $interval;

	/** @var DateTime */
	private $current;

	/** @var integer */
	private $key;

	public function __construct(DateTime $start, DateTime $end, \DateInterval $interval)
	{
		$this->start = $this->current = $start;
		$this->end = $end;
		$this->interval = $interval;
	}

	public function current()
	{
		return $this->current;
	}

	public function key()
	{
		return $this->key;
	}

	public function next()
	{
		$this->key++;
		$this->current = $this->current->add($this->interval);
		return $this->valid();
	}

	public function rewind()
	{
		$this->key = 0;
		$this->current = $this->start;
	}

	public function valid()
	{
		return !$this->current->isAfter($this->end);
	}
}
