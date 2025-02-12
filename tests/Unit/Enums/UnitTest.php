<?php

declare(strict_types=1);

use Copper\Copper;
use Copper\Enums\Unit;

it('returns correct name for each unit', function (Unit $unit, string $expectedName) {
    expect($unit->name())->toBe($expectedName);
})->with([
    [Unit::SECOND, 'Second'],
    [Unit::METRE, 'Metre'],
    [Unit::GRAM, 'Gram'],
    [Unit::AMPERE, 'Ampere'],
    [Unit::KELVIN, 'Kelvin'],
    [Unit::MOLE, 'Mole'],
    [Unit::CANDELA, 'Candela'],
    [Unit::RADIAN, 'Radian'],
    [Unit::STERADIAN, 'Steradian'],
    [Unit::HERTZ, 'Hertz'],
    [Unit::NEWTON, 'Newton'],
    [Unit::PASCAL, 'Pascal'],
    [Unit::JOULE, 'Joule'],
    [Unit::WATT, 'Watt'],
    [Unit::COULOMB, 'Coulomb'],
    [Unit::VOLT, 'Volt'],
    [Unit::FARAD, 'Farad'],
    [Unit::OHM, 'Ohm'],
    [Unit::SIEMENS, 'Siemens'],
    [Unit::WEBER, 'Weber'],
    [Unit::TESLA, 'Tesla'],
    [Unit::HENRY, 'Henry'],
    [Unit::CELSIUS, 'Celsius'],
    [Unit::LUMEN, 'Lumen'],
    [Unit::LUX, 'Lux'],
    [Unit::BECQUEREL, 'Becquerel'],
    [Unit::GRAY, 'Gray'],
    [Unit::SIEVERT, 'Sievert'],
    [Unit::KATAL, 'Katal'],
]);

it('throws exception for invalid unit conversion', function () {
    expect(fn () => Copper::create(1234.56)->unit('invalid_unit'))
        ->toThrow(TypeError::class);
});

it('formats a number with SI units and prefixes for edge cases', function (float $value, string $output) {
    Copper::create($value);
    $result = Copper::unit(Unit::METRE);
    expect($result)->toBe($output);
})->with([
    [0.001, '1 mm'],
    [0.000001, '1 &micro;m'],
    [0.000000001, '1 nm'],
    [0.000000000001, '1 pm'],
    [0.000000000000001, '1 fm'],
    [0.000000000000000001, '1 am'],
    [0.000000000000000000001, '1 zm'],
    [0.000000000000000000000001, '1 ym'],
]);
