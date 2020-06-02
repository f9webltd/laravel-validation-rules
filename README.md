# Useful Laravel Validation Rules

Some useful Laravel validation rules.

## Available rules

* Simple API
* Laravel `>=5.8 | 6.x | 7.x` are supported
* Render named, property type, raw, Twitter card and OpenGraph tags
* Render default tags on every request
* There is no need to set meta titles for every controller method. The package can optionally guess titles based on uri segments or the current named route
* Well documented

## Requirements

PHP >= 7.2, Laravel >= 5.8.

## Installation

``` bash
composer require f9webltd/laravel-meta
```

The package will automatically register itself.

## Usage

As discussed in the official [Laravel documentation](https://laravel.com/docs/master/validation#using-rule-objects), import the required rule whenever required:

```php
use F9Web\ValidationRules\Rules\TitleCase;

// ...

$request->validate([
    'team' => ['required', new TitleCase()],
]);
```

Alternatively use the rule directly with a [Laravel form request object](https://laravel.com/docs/7.x/validation#form-request-validation)

## Available rules

To follow ...

## Contribution

Any ideas are welcome. Feel free to submit any issues or pull requests.

## Testing

``` bash
composer test
```

## Security

If you discover any security related issues, please email rob@f9web.co.uk instead of using the issue tracker.

## Credits

- [Rob Allport](https://github.com/ultrono)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
