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
We have 4 methods to compare object with each other. Names of methods are the same for `Date` and `DateTime`:
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

## Addition and subtraction
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

/** DateTime has all of above methods and few more */
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

## Start date and end date
The same rule as above - all those methods create a new object:
```php
$date = Date::today();

$date->startOfWeek();  // Monday of the current week at 00:00:00
$date->endOfWeek();	   // Sunday of the current week at 23:59:59

$date->startOfMonth(); // First day of the current month at 00:00:00
$date->endOfMonth();   // Last day of the current month at 23:59:59

$date->startOfYear();  // First day of the current year at 00:00:00
$date->endOfYear();    // Last day of the current year at 23:59:59

/** DateTime has all of above methods and two more */
$datetime = DateTime::today();

$datetime->startOfDay(); // The current day at 00:00:00
$datetime->endOfDay();   // The current day at 23:59:59
```
Behaviour of all of those methods can be changed using different Strategies. Read more about [Strategy](strategy.md).

## Formating

### `format()` method
We can format date objects like the PHP DateTime object ([manual](http://www.php.net/manual/en/function.date.php)):
```php
$date = new Date('2014-08-24');

echo $date->format('Y-m-d');    // 2014-08-24
echo $date->format('l, d F Y'); // Sunday, 24 August 2014
```
It's possible to get translated values for name of days and name of months. For example for polish translations:
```php
Date::setLocale('pl');
echo $date->format('l, d F Y') . "\n"; // Niedziela, 24 sierpień 2014
```
Read more about [Translator](translator.md). Notice that `setLocale()` is a static method, so it'll be a good idea to call it
in some bootstrap or setup file.

### 'since()', 'sinceAlmost()' method
The easiest way to explain how this two works is by example:
```php
$now = DateTime::now();

/** We're using subtraction here because we want objects for dates before 'now' */

$datetime = $now->subSeconds('30');
echo $datetime->since(); // just now

$datetime = $now->subMinutes('5');
echo $datetime->since(); // 5 minutes ago

$datetime = $now->subMinutes('75');
echo $datetime->since(); // 1 hour ago

/** Get difference between two dates is also possible */
$today = DateTime::today();

echo $today->since(DateTime::yesterday()); // in 1 day
echo $today->since(DateTime::tomorrow());  // 1 day ago 

/** And sinceAlmost() */
$datetime = $now->subMinutes(55);
echo $datetime->sinceAlmost(); // almost 1 hour ago
```
`since()` method gets two arguments: date to compare to (defaults = null, which means `now`) and detailLevel (defaults = 1).
The first one is obvious so let's focus on the second one - this is how many informations do you wanna get. Again an example
will explain it better than my words:
```php
$now = DateTime::now();
$datetime = $now->subMinutes('75')->subSeconds(20);

echo $datetime->since();                   // 1 hour ago
echo $datetime->since(DateTime::now(), 1); // 1 hour ago
echo $datetime->since(DateTime::now(), 2); // 1 hour and 15 minutes ago
echo $datetime->since(DateTime::now(), 3); // 1 hour, 15 minutes and 20 seconds ago
```
If you don't like it you can provide your own object to handle creation process of these strings. Read more about [Since](since.md).

It's possible to get translated values for these strings. For example for polish translations:
```php
Date::setLocale('pl');

$now = DateTime::now();
$datetime = $now->subMinutes('75')->subSeconds(20);

echo $datetime->since();                   // 1 godzinę temu
echo $datetime->since(DateTime::now(), 1); // 1 godzinę temu
echo $datetime->since(DateTime::now(), 2); // 1 godzinę i 15 minut temu
echo $datetime->since(DateTime::now(), 3); // 1 godzinę, 15 minut i 20 sekund temu
```
Read more about [Translator](translator.md). Notice that `setLocale()` is a static method, so it'll be a good idea to call it
in some bootstrap or setup file.
