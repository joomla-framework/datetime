# The DateTime Package
[![Build Status](https://travis-ci.org/joomla-framework/datetime.svg?branch=master)](https://travis-ci.org/joomla-framework/datetime) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/joomla-framework/datetime/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/joomla-framework/datetime/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/joomla-framework/datetime/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/joomla-framework/datetime/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/joomla/datetime/v/stable)](https://packagist.org/packages/joomla/datetime)
[![Total Downloads](https://poser.pugx.org/joomla/datetime/downloads)](https://packagist.org/packages/joomla/datetime)
[![Latest Unstable Version](https://poser.pugx.org/joomla/datetime/v/unstable)](https://packagist.org/packages/joomla/datetime)
[![License](https://poser.pugx.org/joomla/datetime/license)](https://packagist.org/packages/joomla/datetime)

This is a DateTime package built for the Joomla! Framework during Google Summer of Code 2014.
The main goal for this library was to create a DateTime object as an [Immutable Value Object](http://magazine.joomla.org/issues/issue-july-2014/item/2111-the-value-of-value-objects).

## Immutability
If you know how to use PHP `DateTime` object then you know almost everything about that package.
Before you start using it you need to know one more thing - this `DateTime` is immutable. To explain what immutability means
let's take a look at an example:

```php
$start = new DateTime('2014-08-24');
$end = $start->addDays(2);

echo $start->format('Y-m-d');  // 2014-08-24
echo $end->format('Y-m-d');    // 2014-08-26
```

Every method of `DateTime` is returning a new object and is not changing the current one. That's the most important thing what you have to know.

## Usage
* [Date & DateTime](doc/date-and-datetime.md)
* [DateRange & DateTimeRange](doc/daterange-and-datetimerange.md)
* [DateInterval](doc/dateinterval.md)
* [GetterInterface](doc/getter.md)
* [ParserInterface](doc/parser.md)
* [SinceInterface](doc/since.md)
* [AbstractTranslator](doc/translator.md)
* [StrategyInterface](doc/strategy.md)

## Credits
[Jens Segers](http://github.com/jenssegers/laravel-date) for their approach to translations

## Installation via Composer

Add `"joomla/datetime": "~2.0"` to the require block in your composer.json and then run `composer install`.

```json
{
	"require": {
		"joomla/datetime": "~2.0"
	}
}
```

Alternatively, you can simply run the following from the command line:

```sh
composer require joomla/date "~2.0"
```
