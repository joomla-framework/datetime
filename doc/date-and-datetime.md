# Date and DateTime

We have two different classes for dates: `Date` and `DateTime`. `Date` is just a day-precision wrapper around `DateTime`. There is no inheritance between this two.

## Creating dates

### Constructor
We can create date objects just like the PHP DateTime object ([manual](http://www.php.net/manual/en/datetime.construct.php)):
```php
$datetime = new DateTime('2014-08-24');
$datetime = new DateTime('2014-08-24 12:00:00');

$date = new Date('2014-08-24');
$date = new Date('2014-08-24 12:00:00'); // time part will be trimmed to 00:00:00
```

#### Casting objects via constructor
You can also pass an object into constructor:
```php
$phpDateTime = new \DateTime('2014-08-24');
$date = new Date('2014-08-24');

$datetime = new DateTime($phpDateTime);
$datetime = new DateTime($date);

$date = new Date($phpDateTime);
$date = new Date($datetime);
```

### Factory methods
We have some factory methods which we can use to create date objects:
```php
$datetime = DateTime::createFromFormat('Y-m-d', '2014-08-24');

$datetime = DateTime::create(2014, 8, 24, 12, 0, 0);
$datetime = DateTime::createFromDate(2014, 8, 24); // time = 00:00:00
$datetime = DateTime::createFromTime(12, 0, 0);    // date = today

$datetime = DateTime::now();
$datetime = DateTime::today();     // time = 00:00:00
$datetime = DateTime::tomorrow();  // time = 00:00:00
$datetime = DateTime::yesterday(); // time = 00:00:00

$date = Date::today();
$date = Date::tomorrow();
$date = Date::yesterday();
```

## Comparing dates
We have 4 methods to compare object with each other. Names of the methods are the same for `Date` and `DateTime`:
```php
$today = Date::today();

$today->isAfter(Date::tomorrow());  // false
$today->isAfter(Date::yesterday()); // true

$today->isBefore(Date::tomorrow());  // true
$today->isBefore(Date::yesterday()); // false

$today->equals(Date::tomorrow());    // false
$today->equals(Date::today());       // true

$interval = $today->diff(Date::tomorrow());
```
`diff()` method is returning [DateInterval](dateinterval.md) object. It's not the PHP DateInterval.

## Manipulating dates
We have a bunch of manipulating methods. __We have to remember that all those methods don't change the value of the current
object. They create a new object:__
```php
$date = Date::today();

$date = $date->addDays(1);
$date = $date->subDays(1);

$date = $date->addWeeks(1);
$date = $date->subWeeks(1);

$date = $date->addMonths(1);
$date = $date->subMonths(1);

$date = $date->addYears(1);
$date = $date->subYears(1);

/** DateTime has all of above methods too */
$datetime = DateTime::today();

$datetime = $datetime->addSeconds(1);
$datetime = $datetime->subSeconds(1);

$datetime = $datetime->addMinutes(1);
$datetime = $datetime->subMinutes(1);

$datetime = $datetime->addHours(1);
$datetime = $datetime->subHours(1);

$datetime = $datetime->add(new DateInterval('P1D'));
$datetime = $datetime->sub(new DateInterval('P1D'));
```