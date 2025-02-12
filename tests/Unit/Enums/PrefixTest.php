<?php

declare(strict_types=1);

use Copper\Enums\Prefix;

it('returns correct symbol for each prefix', function (Prefix $prefix, string $expectedSymbol) {
    expect($prefix->symbol())->toBe($expectedSymbol);
})->with([
    [Prefix::QUETTA, 'Q'],
    [Prefix::RONNA, 'R'],
    [Prefix::YOTTA, 'Y'],
    [Prefix::ZETTA, 'Z'],
    [Prefix::EXA, 'E'],
    [Prefix::PETA, 'P'],
    [Prefix::TERA, 'T'],
    [Prefix::GIGA, 'G'],
    [Prefix::MEGA, 'M'],
    [Prefix::KILO, 'k'],
    [Prefix::HECTO, 'h'],
    [Prefix::DECA, 'da'],
    [Prefix::DECI, 'd'],
    [Prefix::CENTI, 'c'],
    [Prefix::MILLI, 'm'],
    [Prefix::MICRO, '&micro;'],
    [Prefix::NANO, 'n'],
    [Prefix::PICO, 'p'],
    [Prefix::FEMTO, 'f'],
    [Prefix::ATTO, 'a'],
    [Prefix::ZEPTO, 'z'],
    [Prefix::YOCTO, 'y'],
    [Prefix::RONTO, 'r'],
    [Prefix::QUECTO, 'q'],
    [Prefix::BASE, ''],
]);

it('checks if prefix is multiple of three', function (Prefix $prefix, bool $expectedResult) {
    expect($prefix->multipleOfThree())->toBe($expectedResult);
})->with([
    [Prefix::QUETTA, true],
    [Prefix::RONNA, true],
    [Prefix::YOTTA, true],
    [Prefix::ZETTA, true],
    [Prefix::EXA, true],
    [Prefix::PETA, true],
    [Prefix::TERA, true],
    [Prefix::GIGA, true],
    [Prefix::MEGA, true],
    [Prefix::KILO, true],
    [Prefix::HECTO, false],
    [Prefix::DECA, false],
    [Prefix::DECI, false],
    [Prefix::CENTI, false],
    [Prefix::MILLI, true],
    [Prefix::MICRO, true],
    [Prefix::NANO, true],
    [Prefix::PICO, true],
    [Prefix::FEMTO, true],
    [Prefix::ATTO, true],
    [Prefix::ZEPTO, true],
    [Prefix::YOCTO, true],
    [Prefix::RONTO, true],
    [Prefix::QUECTO, true],
    [Prefix::BASE, true],
]);
