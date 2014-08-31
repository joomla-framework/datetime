# DateRange and DateTimeRange
Most of the time we need just a single object of `DateTime`, but sometimes we need more of them with certain distances from each other.
To avoid creating some nasty foreach loop for it we can use a `DateRange` or a `DateTimeRange` object for it. Both classes implement
[`IteratorAggregate`](http://php.net/manual/en/class.iteratoraggregate.php), so you can use objects of these classes in foreach loops.

`DateRange` is just a wrapper for day-precision of `DateTimeRange` and instead of `DateTime` objects is using `Date` objects.

##  Creating ranges

### Constructor
```php
use Joomla\DateTime;

$dateRange = new DateRange(new Date('2014-08-01'), new Date('2014-08-05'));
$datetimeRange = new DateTimeRange(new DateTime('2014-08-01 12:00'), new DateTime('2014-08-01 17:00'), new DateInterval('P1H'));
```

### Factory methods
If we want to get a specific number of dates in the range we can use one of two factory methods:
```php
use Joomla\DateTime;

$dateRange = DateRange::from(new Date('2014-08-11'), 10); // from 2014-08-11 to 2014-08-20
$dateRange = DateRange::to(new Date('2014-08-11'), 10);   // from 2014-08-02 to 2014-08-11

$datetimeRange = DateTimeRange::from(new DateTime('2014-08-11 12:00'), 10, new DateInterval('P1H')); // from 2014-08-11 12:00 to 2014-08-11 21:00
$datetimeRange = DateTimeRange::to(new DateTime('2014-08-11 12:00'), 10, new DateInterval('P1H'));   // from 2014-08-11 03:00 to 2014-08-11 12:00
```

Instead of `null` value we can use [`null object`](http://refactoring.com/catalog/introduceNullObject.html):
```php
use Joomla\DateTime;

$empty = DateRange::emptyRange();
$empty = DateTimeRange::emptyRange();
```

## Determining the correlation
We have five methods to determine correlation between ranges or between a range and a date. The names of methods are the same for
`DateRange` and `DateTimeRange`:

### `includes()`
```php
use Joomla\DateTime;

$range = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));

$range->includes(new Date('2014-08-19')); // false
$range->includes(new Date('2014-08-20')); // true
$range->includes(new Date('2014-08-24')); // true
$range->includes(new Date('2014-08-25')); // false
```

### `includesRange()`
```php
use Joomla\DateTime;

$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));
$rangeB = new DateRange(new Date('2014-08-20'), new Date('2014-08-22'));
$rangeC = new DateRange(new Date('2014-08-18'), new Date('2014-08-22'));

$rangeA->includesRange($rangeB); // true
$rangeA->includesRange($rangeC); // false
```

### `overlaps()`
```php
use Joomla\DateTime;

$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));
$rangeB = new DateRange(new Date('2014-08-23'), new Date('2014-08-29'));
$rangeC = new DateRange(new Date('2014-08-25'), new Date('2014-08-29'));

$rangeA->overlaps($rangeB); // true
$rangeA->overlaps($rangeC); // false
```

### `abuts()`
```php
use Joomla\DateTime;

$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));
$rangeB = new DateRange(new Date('2014-08-23'), new Date('2014-08-29'));
$rangeC = new DateRange(new Date('2014-08-25'), new Date('2014-08-29'));

$rangeA->abuts($rangeB); // false
$rangeA->abuts($rangeC); // true
```

### `gap()`
This one is different from others, because it creates a gap range between two ranges.
If the gap doesn't exist then it will return an empty range.
```php
use Joomla\DateTime;

$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));
$rangeB = new DateRange(new Date('2014-08-27'), new Date('2014-08-29'));
$rangeC = new DateRange(new Date('2014-08-22'), new Date('2014-08-29'));

$rangeA->gap($rangeB); // from 2014-08-25 to 2014-08-26
$rangeA->gap($rangeC); // DateRange::emptyRange();
```

## Comparing ranges
```php
use Joomla\DateTime;

$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));
$rangeB = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));
$rangeA->equals($rangeB); // true

$rangeA->isEmpty();                 // false
$rangeB->isEmpty();                 // false
DateRange::emptyRange()->isEmpty(); // true
```

## Combination of ranges
If you have many ranges and they are contiguous then you can join them into one:
```php
use Joomla\DateTime;

$ranges = array(
	new DateRange(new Date('2014-08-01'), new Date('2014-08-08')),
	new DateRange(new Date('2014-08-09'), new Date('2014-08-15')),
	new DateRange(new Date('2014-08-16'), new Date('2014-08-24')),
);

$range = DateRange::combination($ranges); // from 2014-08-01 to 2014-08-24
```

## Iterator
Both classes implement [`IteratorAggregate`](http://php.net/manual/en/class.iteratoraggregate.php). This allows you to use an object of a
range in a foreach loop. Besides that you can also get an array of all dates included in a range, by calling `toArray()` method.
```php
use Joomla\DateTime;

$range = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));

foreach($range as $date) {
	echo $date->format('Y-m-d');
}

/** Results:
 2014-08-20
 2014-08-21
 2014-08-22
 2014-08-23
 2014-08-24
 */

$array = $range->toArray(); // an array of five Date objects from 2014-08-20 to 2014-08-24
```
