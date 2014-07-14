<?php

namespace Joomla\DateTime;

//use Symfony\Component\Translation\MessageSelector;

final class TranslationTest extends \PHPUnit_Framework_TestCase
{
	private $path;

	/** @var array */
	private $languages;

    public function setUp()
    {
        $this->path = __DIR__ . '/../lang/';
		$this->languages = array_slice(str_replace('.php', '', scandir($this->path)), 2);
    }

    public function testMultiplePluralForms()
    {
        /*DateTime::setLocale('pl');

		$date = DateTime::now();

        $this->assertSame("Prije 1 godinu", $date->subHours(1)->timeSince());
        $this->assertSame("Prije 2 godine", $date->subHours(2)->timeSince());
        $this->assertSame("Prije 3 godine", $date->subHours(3)->timeSince());
        $this->assertSame("Prije 5 godina", $date->subHours(4)->timeSince());*/
    }
/*
    public function testCustomSuffix()
    {
        Date::setLocale('de');

        $date = Date::parse('-1 month');
        $this->assertSame("vor 1 Monat", $date->ago());

        $date = Date::parse('-5 months');
        $this->assertSame("vor 5 Monaten", $date->ago());

        $date = Date::parse('-5 seconds');
        $this->assertSame("vor 5 Sekunden", $date->ago());
    }
*/
    public function testTranslatesMonths()
    {
        $months = array(
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december'
        );

        foreach($this->languages as $language)
        {
            $translations = include $this->path . $language . '.php';

            foreach($months as $month)
            {
                $date = new DateTime("1 $month");
                $date->setLocale($language);

                $this->assertTrue(isset($translations[$month]));
                $this->assertEquals($translations[$month], $date->format('F'), "Language: $language"); // Full
                $this->assertEquals(substr($translations[$month], 0 , 3), $date->format('M'), "Language: $language"); // Short
            }
        }
    }

    public function testTranslatesDays()
    {
        $days = array(
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday'
        );

        foreach ($this->languages as $language)
        {
            $translations = include $this->path . $language . '.php';

            foreach ($days as $day)
            {
                $date = new DateTime($day);
                $date->setLocale($language);

                $this->assertTrue(isset($translations[$day]));
                $this->assertEquals($translations[$day], $date->format('l'), "Language: $language"); // Full
                $this->assertEquals(substr($translations[$day], 0 , 3), $date->format('D'), "Language: $language"); // Short
            }
        }
    }

    public function testTranslatesDiffForHumans()
    {
        $items = array(
            'ago',
            'from_now',
            'after',
            'before',
            'year',
            'month',
            'week',
            'day',
            'hour',
            'minute',
            'second'
        );

        foreach ($this->languages as $language)
        {
            $translations = include $this->path . $language . '.php';

            foreach ($items as $item)
            {
                $this->assertTrue(isset($translations[$item]), "Language: $language");

                if ( ! $translations[$item])
                {
                    echo "\nWARNING! '$item' not set for language $language";
                    continue;
                }

                if (in_array($item, array('ago', 'from_now', 'after', 'before')))
                {
                    $this->assertContains(':time', $translations[$item], "Language: $language");
                }
                else
                {
                    $this->assertContains(':count', $translations[$item], "Language: $language");
                }
            }
        }
    }
}
