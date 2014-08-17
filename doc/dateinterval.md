# DateInterval
You may wonder why I created a new `DateInterval`. The answer is really simple - PHP `DateInterval` is mutable. Don't worry it's just 
a wrapper and almost all functionality from PHP version are provided. Even more - now you can add intervals to each other. 
Only one functionality is not supported - you can't change the value of DateInterval. But that was what I wanted to achieve 
creating a new DateInterval, so don't treat that as a flaw.

##  Creating intervals

### Constructor
We can create interval objects just like the PHP DateInterval object ([manual](http://php.net/manual/en/dateinterval.construct.php))
or we can pass the PHP DateInterval into a constructor:
```php
$phpInterval = new \DateInterval('P1D');

$interval = new DateInterval('P1D');
$interval = new DateInterval($phpInterval);
```

### Factory method
The same as for PHP DateInterval object ([manual](http://php.net/manual/en/dateinterval.createfromdatestring.php)):
```php
$interval = DateInterval::createFromDateString('1 day');
$interval = DateInterval::createFromDateString('4 years');
$interval = DateInterval::createFromDateString('1 day + 12 hours');
```

## Methods

### `equals()`
We can check if two intervals are equal:
```php
$interval = new DateInterval('P7D');
$interval->equals(new DateInterval('P7D')); // true
$interval->equals(new DateInterval('P1W')); // true, it works beacuse it's some kind of an alias for '7 days'
```
Unfortunately it can't determine that `PT24H` is equal to `P1D`. It just checks if all properties of both objects are equal.

### `invert()`
Returns an inverted DateInterval object:
```php
$interval = new DateInterval('P1D'); // let's call it '+1 day' and then...
$inverted = $interval->invert();     // ... we can call this one as '-1 day'
```

### `add()`
Returns a new DateInterval which will be created by addition absolute values of intervals.
```php
$interval = new DateInterval('P1D');
$interval = $interval->add(new DateInterval('P1D'));   // 'P2D'

$interval = new DateInterval('P20D');
$interval = $interval->add(new DateInterval('P30D'));  // 'P50D'

$interval = new DateInterval('PT100H');
$interval = $interval->add(new DateInterval('PT30H')); // 'PT130H'

$interval = new DateInterval('P10D');
$interval = $interval->add(new DateInterval('PT30H')); // 'P10DT30H'

$interval = new DateInterval('P10D');
$interval = $interval->add($interval->invert());       // 'P20D', because it adds absolute values
```

## Getting PHP `DateInterval`
Sometimes you may need a PHP `DateInterval`. You can get it by `getDateInterval()` method:
```php
$interval = new DateInterval('P1D');
$phpInterval = $interval->getDateInterval();
```