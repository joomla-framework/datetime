# The DateTime Package
[![Build Status](https://travis-ci.org/tomaszhanc/gsoc-datetime.svg?branch=master)](https://travis-ci.org/tomaszhanc/gsoc-datetime) [![Coverage Status](https://img.shields.io/coveralls/tomaszhanc/gsoc-datetime.svg)](https://coveralls.io/r/tomaszhanc/gsoc-datetime?branch=master)

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
