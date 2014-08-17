# Date and DateTime

We have two different classes for dates: `Date` and `DateTime`. `Date` is just a day-precision wrapper around `DateTime`. There is no inheritance between this two.

## Creating dates

### Constructor
```php
# for DateTime
public function __construct($datetime, \DateTimeZone $timezone = null)

# for Date
public function __construct($date)
```



