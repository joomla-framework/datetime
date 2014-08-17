# Getter
Is used to provide properties for `DateTime`. There is a default `Getter` object called `DateTimeGetter`. 
Let's extend a default `Getter` and add two new properties to our `DateTime`.

## Custom `Getter`
Creating a custom `Getter` is simple. We just need to create a class which will be implementing `Getter`
interface:
```php
interface Getter
{
	public function get(DateTime $datetime, $name);
}
```

We don't want to override all properties from default `Getter`. We want to extend it. To do that we will
do our job for two new properties and delegate rest of the job to another `Getter`:
```php
class MyGetter implements Getter
{
	/** @var Getter */
	private $getter;

	public function __construct(Getter $getter)
	{
		$this->getter = $getter;
	}

	public function get(DateTime $datetime, $name)
	{
		$value = null;

		switch ($name)
		{
			case 'date':
				$value = $datetime->format('Y-m-d');
				break;

			case 'time':
				$value = $datetime->format('H:i:s');
				break;

			default:
				$value = $this->getter->get($datetime, $name);
		}

		return $value;
	}
}
```

And now we can inject `MyGetter` into a `DateTime` class:
```php
DateTime::setGetter(new MyGetter(new DateTimeGetter()));

$datetime = new DateTime('2014-08-24 12:00:00');

echo $datetime->date;        // 2014-08-24
echo $datetime->time;        // 12:00:00
echo $datetime->get('date'); // 2014-08-24
echo $datetime->get('time'); // 12:00:00
```
Notice that `setGetter()` is a static method, so it'll be a good idea to call it in some bootstrap or setup file.