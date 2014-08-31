# GetterInterface
Is used to provide properties for `DateTime`. There is a default `GetterInterface` object called `DateTimeGetter`.
Let's extend a default `GetterInterface` and add two new properties to our `DateTime`.

## Custom `GetterInterface`
Creating a custom `GetterInterface` is simple. We just need to create a class which will be implementing `GetterInterface`
interface:
```php
interface GetterInterface
{
	public function get(DateTime $datetime, $name);
}
```

We don't want to override all properties from default `GetterInterface`. We want to extend it. To do that we will
do our job for two new properties and delegate rest of the job to another `GetterInterface`:
```php
use Joomla\DateTime\DateTime;
use Joomla\DateTime\Getter\GetterInterface;

class MyGetter implements GetterInterface
{
	/** @var GetterInterface */
	private $getter;

	public function __construct(GetterInterface $getter)
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
use Joomla\DateTime\DateTime;
use Joomla\DateTime\Getter\DateTimeGetter;

DateTime::setGetter(new MyGetter(new DateTimeGetter()));

$datetime = new DateTime('2014-08-24 12:00:00');

echo $datetime->date;        // 2014-08-24
echo $datetime->time;        // 12:00:00
echo $datetime->get('date'); // 2014-08-24
echo $datetime->get('time'); // 12:00:00
```
Notice that `setGetter()` is a static method, so it'll be a good idea to call it in some bootstrap or setup file.
