# Copper

![](https://banners.beyondco.de/Copper.png?theme=dark&packageName=pwweb%2Fcopper&pattern=morphingDiamonds&style=style_1&description=An+API+extension+for+NumberFormatter&md=1&showWatermark=1&fontSize=100px&images=currency-euro)

[![Latest Stable Version](https://poser.pugx.org/pwweb/copper/v/stable?format=flat-square)](https://packagist.org/packages/pwweb/copper)
[![Total Downloads](https://poser.pugx.org/pwweb/copper/downloads?format=flat-square)](https://packagist.org/packages/pwweb/copper)
[![License](https://poser.pugx.org/pwweb/copper/license?format=flat-square)](https://packagist.org/packages/pwweb/copper)
[![Scrutinizer code quality (GitHub/Bitbucket)](https://img.shields.io/scrutinizer/quality/g/pwweb/copper?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/pwweb/copper/)
[![StyleCI Status](https://github.styleci.io/repos/267909905/shield?branch=master)](https://github.styleci.io/repos/267909905)

**Copper**: An API extension for NumberFormatter.

## Installation

Via Composer run the following:

```bash
$ composer require pwweb/copper
```

## Usage

### Commands

This package makes it easy to format numbers using PHP [`NumberFormatter`](https://www.php.net/manual/en/class.numberformatter.php). In essence it wraps things up in a simple to use API.

To get started you will need to create a new instance:

```php
<?php
...
Copper\Copper::create(?float $value = null, ?int $style = null, ?string $locale = null);
```

 i.e.:

```php
<?php
...
$formatter = Copper\Copper::create(-1234.56, \NumberFormatter::DECIMAL, 'en-GB');
```

If you don't provide a `$style` it will default to `NumberFormatter::DECIMAL`. If you don't provide the `$locale` it will default to the value of the Laravel application.

Then with this you can format in any of the following ways:

| Format     | Code                        | Output                                                    |
| ---------- | --------------------------- | --------------------------------------------------------- |
| Currency   | `$value->currency('GBP')`   | -£1,234.56                                                |
| Decimal    | `$value->decimal(2)`        | -1,234.56                                                 |
| Percentage | `$value->percentage()`      | -123,456%                                                 |
| Scientific | `$value->scientific()`      | -1.23456E3                                                |
| Accounting | `$value->accounting('GBP')` | (£1,234.56)                                               |
| SpellOut   | `$value->spellOut()`        | minus one thousand two hundred thirty-four point five six |

Since the `create()` function returns an instance of `Copper`, you can chain the methods together i.e. `Copper\Copper::create(-1234.56)->currency('EUR')` leads to `-€1,234.56`.

This means that it's particularly helpful in Blade templates:

    {{ Copper\Copper::create($order->value)->currency('USD') }}

In addition to the base functions there are a few setters and getters:

| Function            | Result                                                                                                                                                                  |
| ------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `setStyle(int)`     | Allows for altering the style value.                                                                                                                                    |
| `getstyle(): int`   | Returns the style number currently defined.                                                                                                                             |
| `setLocale(string)` | Allows for changing/specifying the locale within the code i.e. `{{ Copper\Copper::create(-1234.56)->setLocale('de-DE')->currency('EUR') }}` would return `-1.234,56 €`. |

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email securtity@pw-websolutions.com instead of using the issue tracker.

## Credits

-   [Richard Browne](https://github.com/orgs/pwweb/people/rabrowne85)
-   [Frank Pillukeit](https://github.com/orgs/pwweb/people/frankpde)
-   [PWWEB][link-author]
-   [All Contributors][link-contributors]

## License

Copyright © pw-websolutions.com. Please see the [license file](license.md) for more information.

[link-author]: https://github.com/pwweb

[link-contributors]: https://github.com/pwweb/copper/graphs/contributors

˜
