# SinceInterface
Is used to provide creating nice strings for `DateTime`. There is a default `SinceInterface` object called `DateTimeSince`.
`DateTimeSince` object uses [`AbstractTranslator`](translator.md) to handling internalization of these strings. So if
you would like to change only translation funcionality then you don't need to change whole `SinceInterface` object, but
only create a new [`AbstractTranslator`](translator.md).

## Custom `SinceInterface`
Create a class which will be implementing `SinceInterface` interface:
```php
interface SinceInterface
{
	public function since(DateTime $base, DateTime $datetime = null, $detailLevel = 1);

	public function almost(DateTime $base, DateTime $datetime = null);
}
```
If you want to see any example of that class, let's look at [`DateTimeSince`](../src/Since/DateTimeSince.php).

To inject your `SinceInterface` object into `DateTime`:
```php
use Joomla\DateTime\DateTime;

DateTime::setSince(new MySince());
```
Notice that `setSince()` is a static method, so it'll be a good idea to call it in some bootstrap or setup file.
