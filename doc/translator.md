# Translator
Is used to provide translations for `DateTime`. There is a default `Translator` object called `DateTimeTranslator`. 

## Custom `Translator`
Create a class which will be extending `Translator` abstract class:
```php
abstract class Translator
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

To inject your `Translator` object into `DateTime`:
```php
DateTime::setTranslator(new MyTranslator());
```
Notice that `setTranslator()` is a static method, so it'll be a good idea to call it in some bootstrap or setup file.

# DateTimeTranslator
This a default `Translator` for `DateTime`. It uses a Symfony's `MessageSelector` to handle pluralization.