<?php

declare(strict_types=1);

use Copper\Copper;
use Copper\Enums\Unit;

it('creates an instance with default values', function () {
    $copper = Copper::create();
    expect($copper)
        ->toBeInstanceOf(Copper::class)
        ->and(Copper::getLocale())
        ->toBe('en-GB')
        ->and(Copper::getStyle())
        ->toBe(NumberFormatter::DECIMAL);
});

it('creates an instance with custom values', function () {
    $copper = Copper::create(1234.56, NumberFormatter::CURRENCY, 'fr-FR');
    expect($copper)
        ->toBeInstanceOf(Copper::class)
        ->and(Copper::getLocale())
        ->toBe('fr-FR')
        ->and(Copper::getStyle())
        ->toBe(NumberFormatter::CURRENCY);
});

it('formats a number as decimal', function () {
    Copper::create(1234.563, locale: 'en-GB');
    Copper::setStyle(2);
    $result = Copper::decimal(2);
    expect($result)->toBe('1,234.56');
});

it('formats a number as currency', function () {
    Copper::create(1234.56);
    $result = Copper::currency('USD');
    expect($result)->toBe('US$1,234.56');
});

it('formats a number as spellout', function () {
    Copper::create(1234.56);
    $result = Copper::spellOut();
    expect($result)->toBe('one thousand two hundred thirty-four point five six');
});

it('formats a number as percentage', function () {
    Copper::create(0.56);
    $result = Copper::percentage();
    expect($result)->toBe('56%');
});

it('formats a number as scientific', function () {
    Copper::create(1234.56);
    $result = Copper::scientific();
    expect($result)->toBe('1.23456E3');
});

it('formats a number as accounting currency', function () {
    Copper::create(1234.56);
    $result = Copper::accounting('USD');
    expect($result)->toBe('US$1,234.56');
});

it('formats a number with SI units and prefixes', function (float $value, string $output) {
    Copper::create($value);
    Copper::setStyle(2);
    $result = Copper::unit(Unit::METRE);
    expect($result)->toBe($output);
})->with([
    [123_456.99, '0.123 Mm'],
    [12_345.67, '12.346 km'],
    [1_234.56, '1.235 km'],
    [123.45, '0.123 km'],
    [12.34, '12.34 m'],
]);

it('formats a number with SI units and prefixes whilst using the non-multiples of three', function (float $value, string $output) {
    Copper::create($value);
    $result = Copper::unit(Unit::METRE, useThrees: false);
    expect($result)->toBe($output);
})->with([
    [123_456.99, '0.123 Mm'],
    [12_345.67, '12.346 km'],
    [1_234.56, '1.235 km'],
    [123.45, '1.234 hm'],
    [12.34, '1.234 dam'],
]);

it('formats a number with SI units and prefixes with specific precision', function () {
    Copper::create(123456);
    Copper::setStyle(2);
    $result = Copper::unit(Unit::METRE, precision: 2);
    expect($result)->toBe('0.12 Mm');
});

it('sets and gets the locale', function () {
    Copper::setLocale('de-DE');
    expect(Copper::getLocale())->toBe('de-DE');
});

it('sets and gets the style', function () {
    Copper::setStyle(NumberFormatter::CURRENCY);
    expect(Copper::getStyle())->toBe(NumberFormatter::CURRENCY);
});
