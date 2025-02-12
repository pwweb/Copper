<?php

declare(strict_types=1);

namespace Copper\Enums;

enum Prefix: int
{
    case QUETTA = 30;
    case RONNA = 27;
    case YOTTA = 24;
    case ZETTA = 21;
    case EXA = 18;
    case PETA = 15;
    case TERA = 12;
    case GIGA = 9;
    case MEGA = 6;
    case KILO = 3;
    case HECTO = 2;
    case DECA = 1;
    case BASE = 0;
    case DECI = -1;
    case CENTI = -2;
    case MILLI = -3;
    case MICRO = -6;
    case NANO = -9;
    case PICO = -12;
    case FEMTO = -15;
    case ATTO = -18;
    case ZEPTO = -21;
    case YOCTO = -24;
    case RONTO = -27;
    case QUECTO = -30;

    public function symbol(): string {
        return match($this) {
            self::QUETTA => 'Q',
            self::RONNA => 'R',
            self::YOTTA => 'Y',
            self::ZETTA => 'Z',
            self::EXA => 'E',
            self::PETA => 'P',
            self::TERA => 'T',
            self::GIGA => 'G',
            self::MEGA => 'M',
            self::KILO => 'k',
            self::HECTO => 'h',
            self::DECA => 'da',
            self::DECI => 'd',
            self::CENTI => 'c',
            self::MILLI => 'm',
            self::MICRO => '&micro;',
            self::NANO => 'n',
            self::PICO => 'p',
            self::FEMTO => 'f',
            self::ATTO => 'a',
            self::ZEPTO => 'z',
            self::YOCTO => 'y',
            self::RONTO => 'r',
            self::QUECTO => 'q',
            self::BASE => '',
        };
    }

    public function multipleOfThree(): bool {
        return ! abs(self::value) % 3;
    }
}
