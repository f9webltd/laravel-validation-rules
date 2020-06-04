[![Latest Stable Version](https://poser.pugx.org/f9webltd/laravel-validation-rules/v)](https://packagist.org/packages/f9webltd/laravel-validation-rules)
[![Scrutinizer coverage (GitHub/BitBucket)](https://img.shields.io/scrutinizer/coverage/g/f9webltd/laravel-validation-rules)]()
[![Scrutinizer code quality (GitHub/Bitbucket)](https://img.shields.io/scrutinizer/quality/g/f9webltd/laravel-validation-rules)]()
[![Build Status](https://travis-ci.org/f9webltd/laravel-validation-rules.svg)](https://travis-ci.org/f9webltd/laravel-validation-rules)
[![StyleCI Status](https://github.styleci.io/repos/266997689/shield)](https://github.styleci.io/repos/266997689)
[![License](https://poser.pugx.org/f9webltd/laravel-validation-rules/license)](https://packagist.org/packages/f9webltd/laravel-validation-rules)

# Useful Laravel Validation Rules

A collection of Laravel validation rules.

## Requirements

PHP >= 7.2, Laravel `>=5.8 | 6.x | 7.x`.

## Installation

``` bash
composer require f9webltd/laravel-validation-rules
```

To publish the package validation message translations:

``` bash
php artisan vendor:publish --provider="F9Web\ValidationRules\ValidationRulesServiceProvider"
```

Published translations are available at `resources/lang/vendor/f9web-validation-rules/messages.php`.

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

- [`Base64EncodedString`](#base64encodedstring)
- [`Coordinate`](#coordinate)
- [`DomainRestrictedEmail`](#domainrestrictedemail)
- [`EvenNumber`](#evennumber)
- [`ExcludesHtml`](#excludeshtml)
- [`HexColourCode`](#hexcolourcode)
- [`Honorific`](#honorific)
- [`IncludesHtml`](#includeshtml)
- [`NoWhitespace`](#nowhitespace)
- [`OddNumber`](#oddnumber)
- [`StringContains`](#stringcontains)
- [`StrongPassword`](#strongpassword)
- [`TitleCase`](#titlecase)
- [`UKMobilePhone`](#ukmobilephone)
- [`Uppercase`](#uppercase)

### `Base64EncodedString`

Ensure the passed attribute is a valid base 64 encoded string.

### `Coordinate`

Ensure the passed attribute is a valid comma separated Latitude and Longitude string. For example: `51.507877,-0.087732`.

### `DomainRestrictedEmail`

Ensure the passed email in question is part of the provided whitelist of domains. 

For instance, to ensure the given email domain is `f9web.co.uk` or `laravel.com`:

```php
use F9Web\ValidationRules\Rules\DomainRestrictedEmail;

// ...

$request->validate([
    'email' => [
        'required', 
        (new DomainRestrictedEmail())->validDomains([
            'f9web.co.uk',
            'laravel.com',
        ]),
    ],
]);
``` 

The validation message will include the list of whitelisted domains based upon the provided configuration.

### `EvenNumber`

Ensure the passed attribute is an even number.

### `ExcludesHtml`

Ensure the passed attribute does not contain HTML.

### `HexColourCode`

Ensure the passed attribute is a valid hex colour code (three of six characters in length), optionally validating the presence of the `#` prefix.

Minimum usage example to validate a short length code with the prefix i.e. `#fff`:

```php
use F9Web\ValidationRules\Rules\HexColourCode;

(new HexColourCode());
``` 

Extended usage example to validate a long length code , omitting prefix i.e. `cc0000`:

```php
use F9Web\ValidationRules\Rules\HexColourCode;

(new HexColourCode())->withoutPrefix()->longFormat();
``` 

### `Honorific`

Ensure the passed attribute is a valid honorific, omitting appended dots. The list of valid honorifics is available [here](src/Support/Honorifics.php).

### `IncludesHtml`

Ensure the passed attribute contains HTML.

### `NoWhitespace`

Ensure the passed attribute contains no whitespace.

### `OddNumber`

Ensure the passed attribute is an odd number.

### `StringContains`

Ensure the given attribute contains the provided strings.

Minimum usage example to ensure the attribute in question contains the string `php` or `laravel`:

```php
use F9Web\ValidationRules\Rules\StringContains;

// ...

$request->validate([
    'description' => [
        'required', 
        (new StringContains())->phrases([
            'laravel',
            'php',
        ]),
    ],
]);
``` 

Optionally force the string to contain *all* provided phrases:

```php
use F9Web\ValidationRules\Rules\StringContains;

// ...

$request->validate([
    'description' => [
        'required', 
        (new StringContains())->phrases([
            'laravel',
            'php',
        ])->strictly(),
    ],
]);
``` 
The validation message will include the list phrases based upon the provided configuration.

### `StrongPassword`

Ensure the given attribute matches the provided conditions. 

Minimum usage example to ensure the attribute:
 
- is a minimum of eight characters in length
- contains upper and lowercase characters
- contains at least one number

```php
use F9Web\ValidationRules\Rules\StrongPassword;

// ...

$request->validate([
    'password' => [
        'required', 
        (new StrongPassword()),
    ],
]);
``` 

Additional methods are available.

```php
use F9Web\ValidationRules\Rules\StrongPassword;

// ...

$request->validate([
    'password' => [
        'required', 
        (new StrongPassword())
            ->forceUppercaseCharacters()
            ->forceLowercaseCharacters(false)
            ->forceNumbers()
            ->forceSpecialCharacters()
            // ->withSpecialCharacters('£$*%^'),
    ],
]);
``` 

The default special characters are `!@#$%^&*()\-_=+{};:,<."£~?|>`. Optionally the `withSpecialCharacters()` method can be used to define a custom list.

### `TitleCase`

Ensure the provided attribute is [title case](https://laravel.com/docs/7.x/helpers#method-title-case).

### `UKMobilePhone`

Ensure the provided attribute is a valid UK mobile telephone number.

### `Uppercase`

Ensure the provided attribute is entirely uppercase.

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
