<?php

namespace Joomla\DateTime;

class DateTime extends \DateTime
{
    public function add($interval)
    {
        $newDate = new \DateTime($this->format("Y-m-d"));
        $newDate->add($interval);
        return $newDate;
    }
}
