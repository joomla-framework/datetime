# ParserInterface
Is used to provide parsers for `DateTime`. There is no default `ParserInterface` object so we will create
one. We will create a parser from `timestamp` to `DateTime`.

## Custom `ParserInterface`
Creating a custom `ParserInterface` is simple. We just need to create a class which will be implementing `ParserInterface`:
```php
interface ParserInterface
{
	public function parse($name, $value);
}
```
We can take the same approach like when creating a custom [`GetterInterface`](getter.md), but we can do something
prettier. To do that we will create a `MyParser` class by extending `AbstractParser`:
```php
abstract class AbstractParser implements ParserInterface
{
	public function parse($name, $value)
	{
		return call_user_func_array(array($this, $name), array($value));
	}
}
```
`AbstractParser` implements a `parse()` method for us, so we don't need to do it. We just need to create
a method for our parser:
```php
class MyParser extends AbstractParser
{
	public function fromTimestamp($timestamp)
	{
		$datetime = new \DateTime();
		$datetime->setTimestamp($timestamp);

		return new DateTime($datetime);
	}
}
```

And now we can inject `MyParser` into a `DateTime` class:
```php
DateTime::setParser(new MyParser());

$datetime = DateTime::parse('fromTimestamp', 1408838400); // first argument is a name of the method in MyParser class
echo $datetime->format('Y-m-d'); // 2014-08-24
```
Notice that `setParser()` is a static method, so it'll be a good idea to call it in some bootstrap or setup file.
