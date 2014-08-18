# Strategy
Is used to provide behaviours for a few methods of `DateTime`. There is a default `Strategy` object called `DateTimeStrategy`.

## Custom `Strategy`
Create a class which will be implementing `Strategy` interface:
```php
interface Strategy
{	
	public function startOfDay(\DateTime $datetime);

	public function endOfDay(\DateTime $datetime);

	public function startOfWeek(\DateTime $datetime);

	public function endOfWeek(\DateTime $datetime);

	public function startOfMonth(\DateTime $datetime);

	public function endOfMonth(\DateTime $datetime);

	public function startOfYear(\DateTime $datetime);

	public function endOfYear(\DateTime $datetime);
}
```
`DateTimeStrategy` implements that interface and returns the following values:
```php
startOfDay()    // The current day at 00:00:00
endOfDay()      // The current day at 23:59:59

startOfWeek()   // Monday of the current week at 00:00:00
endOfWeek()     // Sunday of the current week at 23:59:59

startOfMonth()  // First day of the current month at 00:00:00
endOfMonth()    // Last day of the current month at 23:59:59

startOfYear()   // First day of the current year at 00:00:00
endOfYear()     // Last day of the current year at 23:59:59
```

Let's say that we want to change the return values of `startOfDay()` and `endOfDay()` to 9.00 and 17.00. 
In fact we want to only override two default behaviours so it's better to create class by extending `DateTimeStrategy`
instead of by implementing `Strategy` interface.
```php
class MyStrategy extends DateTimeStrategy
{
	public function startOfDay(\DateTime $datetime)
	{
		$datetime->setTime(9, 0, 0);
	}

	public function endOfDay(\DateTime $datetime)
	{
		$datetime->setTime(17, 0, 0);
	}
}
```
Notice that in all methods of a `Stategy` we get a PHP `DateTime` object and we make a use of its mutability.
All changes we make to that PHP `DateTime` object and we even don't need to return it.

## Custom `DateTime`
In fact changing a `Strategy` is a important process. This is why there isn't a public static `setStrategy()` method, because
it would make more troubles than gains. For example there would be impossible to have a two different strategies in our project. 
Because when we makes a `Strategy` as a class property than we can have only one of it. Changing a `Strategy` back and forth is also not a 
good idea. We also can't set a `Strategy` for our objects because when we forgot about it that we set one we'll be getting
not expecting results. So to don't remember if we set some or not, we need an object to tell us about it. How to do that? 
Create a custom `DateTime` and set a `Strategy` in a `constructor`:
```php
class MyDateTime extends DateTime
{
	public function __construct($datetime, \DateTimeZone $timezone = null)
	{
		parent::__construct($datetime, $timezone);
		$this->setStrategy(new MyStrategy());
	}
}
```
And now everywhere when we would have a `MyDateTime` object we'll be certain that this object has changed behavior of some methods.
