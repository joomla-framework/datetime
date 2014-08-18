# Since
Is used to provide creating nice strings for `DateTime`. There is a default `Since` object called `DateTimeSince`.
`DateTimeSince` object uses [`Translator`](translator.md) to handling internalization of these strings. So if
you would like to change only translation funcionality then you don't need change whole `Since` object, but
only create a new [`Translator`](translator.md).

## Custom `Since`
Create a class which will be implementing `Since` interface:
```php
interface Since
{
	public function since(DateTime $base, DateTime $datetime = null, $detailLevel = 1);

	public function almost(DateTime $base, DateTime $datetime = null);
}
```
If you want to see any example of that class, let's look at [`DateTimeSince`](src/Since/DateTimeSince.php).

To inject your `Since` object into `DateTime`:
```php
DateTime::setSince(new MySince());
```
Notice that `setSince()` is a static method, so it'll be a good idea to call it in some bootstrap or setup file.