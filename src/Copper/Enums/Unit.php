<?php

declare(strict_types=1);

namespace Copper\Enums;

enum Unit: string
{
    case SECOND = 's';
    case METRE = 'm';
    case GRAM = 'g';
    case AMPERE = 'A';
    case KELVIN = 'K';
    case MOLE = 'mol';
    case CANDELA = 'cd';
    case RADIAN = 'rad';
    case STERADIAN = 'sr';
    case HERTZ = 'Hz';
    case NEWTON = 'N';
    case PASCAL = 'Pa';
    case JOULE = 'J';
    case WATT = 'W';
    case COULOMB = 'C';
    case VOLT = 'V';
    case FARAD = 'F';
    case OHM = '&ohm;';
    case SIEMENS = 'S';
    case WEBER = 'Wb';
    case TESLA = 'T';
    case HENRY = 'H';
    case CELSIUS = '&deg;C';
    case LUMEN = 'lm';
    case LUX = 'lx';
    case BECQUEREL = 'Bq';
    case GRAY = 'Gy';
    case SIEVERT = 'Sv';
    case KATAL = 'kat';

    public function name(): string {
        return match($this)
        {
            self::SECOND => 'Second',
            self::METRE => 'Metre',
            self::GRAM => 'Gram',
            self::AMPERE => 'Ampere',
            self::KELVIN => 'Kelvin',
            self::MOLE => 'Mole',
            self::CANDELA => 'Candela',
            self::RADIAN => 'Radian',
            self::STERADIAN => 'Steradian',
            self::HERTZ => 'Hertz',
            self::NEWTON => 'Newton',
            self::PASCAL => 'Pascal',
            self::JOULE => 'Joule',
            self::WATT => 'Watt',
            self::COULOMB => 'Coulomb',
            self::VOLT => 'Volt',
            self::FARAD => 'Farad',
            self::OHM => 'Ohm',
            self::SIEMENS => 'Siemens',
            self::WEBER => 'Weber',
            self::TESLA => 'Tesla',
            self::HENRY => 'Henry',
            self::CELSIUS => 'Celsius',
            self::LUMEN => 'Lumen',
            self::LUX => 'Lux',
            self::BECQUEREL => 'Becquerel',
            self::GRAY => 'Gray',
            self::SIEVERT => 'Sievert',
            self::KATAL => 'Katal',
        };
    }
}
