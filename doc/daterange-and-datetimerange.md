# DateRange and DateTimeRange
Most of the times we need just a single object of `DateTime`, but sometimes we need more of them with certain distances from each other.
To avoid creating some nasty foreach loop for it we can use a `DateRange` or a `DateTimeRange` object for it. Both classes implement 
an [`IteratorAggregate`](http://php.net/manual/en/class.iteratoraggregate.php) interface, so you can use objects of these classes in foreach loops.

`DateRange` is just a wrapper for day-precision of `DateTimeRange` and instead of `DateTime` objects is using `Date` objects.

##  Creating ranges

### Constructor
```php
$dateRange = new DateRange(new Date('2014-08-01'), new Date('2014-08-05'));

$datetimeRange = new DateTimeRange(new DateTime('2014-08-01 12:00'), new DateTime('2014-08-01 17:00'), new DateInterval('P1H'));
```

### Factory methods
If we want to get a specific number of dates in the range we can use one of two factory methods:
```php
$dateRange = DateRange::from(new Date('2014-08-11'), 10); // from 2014-08-11 to 2014-08-20
$dateRange = DateRange::to(new Date('2014-08-11'), 10);   // from 2014-08-02 to 2014-08-11

$datetimeRange = DateTimeRange::from(new DateTime('2014-08-11 12:00'), 10, new DateInterval('P1H')); // from 2014-08-11 12:00 to 2014-08-11 21:00
$datetimeRange = DateTimeRange::to(new DateTime('2014-08-11 12:00'), 10, new DateInterval('P1H'));   // from 2014-08-11 03:00 to 2014-08-11 12:00
```
Instead of `null` value we can use `[null object](http://refactoring.com/catalog/introduceNullObject.html)`:
```php
$empty = DateRange::emptyRange();

$empty = DateTimeRange::emptyRange();
``

## Determining the correlation
We have 5 methods to determine correlation between ranges or between a range and a date. Names of methods are the same for 
`DateRange` and `DateTimeRange`:

### `includes()`
```php
$range = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));

$range->includes(new Date('2014-08-19')); // false
$range->includes(new Date('2014-08-20')); // true
$range->includes(new Date('2014-08-24')); // true
$range->includes(new Date('2014-08-25')); // false
```

### `includesRange()`
```php
$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));

$rangeB = new DateRange(new Date('2014-08-20'), new Date('2014-08-22'));
$rangeC = new DateRange(new Date('2014-08-18'), new Date('2014-08-22'));

$rangeA->includesRange($rangeB); // true
$rangeA->includesRange($rangeC); // false
```

### `overlaps()`
```php
$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));

$rangeB = new DateRange(new Date('2014-08-23'), new Date('2014-08-29'));
$rangeC = new DateRange(new Date('2014-08-25'), new Date('2014-08-29'));

$rangeA->overlaps($rangeB); // true
$rangeA->overlaps($rangeC); // false
```

### `abuts()`
```php
$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));

$rangeB = new DateRange(new Date('2014-08-23'), new Date('2014-08-29'));
$rangeC = new DateRange(new Date('2014-08-25'), new Date('2014-08-29'));

$rangeA->abuts($rangeB); // false
$rangeA->abuts($rangeC); // true
```

### `gap()`
This one is different from others because it creates a gap range between two ranges.
If the gap doesn't exist then it will return an empty range.
```php
$rangeA = new DateRange(new Date('2014-08-20'), new Date('2014-08-24'));

$rangeB = new DateRange(new Date('2014-08-27'), new Date('2014-08-29'));
$rangeC = new DateRange(new Date('2014-08-22'), new Date('2014-08-29'));

$rangeA->gap($rangeB); // from 2014-08-25 to 2014-08-26
$rangeA->gap($rangeC); // DateRange::emptyRange();
```

## Comparing ranges
`equals()`
`isEmpty()`

## Combination of ranges

## IteratorAggregate
