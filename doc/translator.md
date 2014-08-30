# AbstractTranslator
Is used to provide translations for `DateTime`. There is a default `AbstractTranslator` object called `DateTimeTranslator`.

## Custom `AbstractTranslator`
Create a class which will be extending `AbstractTranslator`:
```php
abstract class AbstractTranslator
{
	protected $locale = 'en';

	public function setLocale($locale)
	{
		$this->locale = $locale;
	}

	/** Returns a translated item. */
	abstract public function get($item, array $replace = array());

	/** Returns a translated item with a proper form for pluralization. */
	abstract public function choice($item, $number, array $replace = array());
}
```

If you want to see any example of that class, let's look at [`DateTimeTranslator`](../src/Translator/DateTimeTranslator.php).

To inject your `AbstractTranslator` object into `DateTime`:
```php
use Joomla\DateTime\DateTime;

DateTime::setTranslator(new MyTranslator());
```

Notice that `setTranslator()` is a static method, so it'll be a good idea to call it in some bootstrap or setup file.

## DateTimeTranslator
The default `AbstractTranslator` for `DateTime`. It uses a Symfony's `MessageSelector` to handle pluralization.
