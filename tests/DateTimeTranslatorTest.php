<?php

namespace Joomla\DateTime;

final class DateTimeTranslatorTest extends \PHPUnit_Framework_TestCase
{
	private $path;

	/** @var array */
	private $languages;

    public function setUp()
    {
        $this->path = __DIR__ . '/../src/Translator/lang/';
		$this->languages = array_slice(str_replace('.php', '', scandir($this->path)), 2);
    }

	/**
	 * @dataProvider seedForTimeSince_pl
	 */
	public function testTimeSince_pl($detailLevel, DateTime $since, DateTime $sut, $string)
	{
		DateTime::setLocale('pl');
		$this->assertEquals($string, $sut->timeSince($since, $detailLevel));
	}

	/**
	 * @dataProvider seedForAlmostTimeSince_pl
	 */
	public function testAlmostTimeSince_pl(DateTime $since, DateTime $sut, $string)
	{
		DateTime::setLocale('pl');
		$this->assertEquals($string, $sut->almostTimeSince($since));
	}

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
			'in',
            'ago',
            'from_now',
			'just_now',
			'and',
			'almost',
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
                $this->assertTrue(isset($translations[$item]), "Language: $language, Item: $item");

                if ( ! $translations[$item])
                {
                    echo "\nWARNING! '$item' not set for language $language";
                    continue;
                }

				if(!in_array($item, array('just_now', 'and'))) {
					if (in_array($item, array('in', 'almost', 'ago', 'from_now', 'after', 'before')))
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

	public function seedForTimeSince_pl()
	{
		return Fixture\DataProvider::timeSince_pl();
	}

	public function seedForAlmostTimeSince_pl()
	{
		return Fixture\DataProvider::AlmostTimeSince_pl();
	}
}
