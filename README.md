# The DateTime Package
[![Build Status](https://travis-ci.org/tomaszhanc/gsoc-datetime.svg?branch=master)](https://travis-ci.org/tomaszhanc/gsoc-datetime) [![Coverage Status](https://img.shields.io/coveralls/tomaszhanc/gsoc-datetime.svg)](https://coveralls.io/r/tomaszhanc/gsoc-datetime?branch=master)

This is a DateTime package built for Joomla! Framework during Google Summer of Code 2014.
The main goal for this library was to create DateTime object as an [immutable Value Object](http://magazine.joomla.org/issues/issue-july-2014/item/2111-the-value-of-value-objects).

## Immutability
If you know how to use PHP `DateTime` object then you know almost everything about that package. 
Before you start using it you need to know one thing - this `DateTime` is immutable. Let's take a look at an example:

```php
$start = new DateTime('2014-08-24');
$end = $start->addDays(2);

echo $start->format('Y-m-d');  // 2014-08-24
echo $end->format('Y-m-d');    // 2014-08-26
```

Every method od `DateTime` is returning a new object and is not changing the current one. That's the most important thing you have to know.

# Credits

[Jens Segers](http://github.com/jenssegers/laravel-date) for his approach to translations
