<?php

declare(strict_types=1);

/**
 * This file is part of the Copper package.
 *
 * (c) Richard Browne <richard.browne@pw-websolutions.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Copper;

use Copper\Enums\Prefix;
use Copper\Enums\Unit;
use NumberFormatter;

/**
 * A simple API extension for NumberFormatter.
 */
class Copper
{
    /**
     * Locale for instance.
     */
    public static string $locale = 'en-GB';

    /**
     * Formatter instance.
     */
    public static NumberFormatter $formatter;

    /**
     * Instance of self.
     */
    public static ?Copper $instance = null;

    /**
     * Style of formatter to use.
     */
    public static int $style = NumberFormatter::DECIMAL;

    /**
     * Value of the number to format.
     */
    public static float $value;

    /**
     * Default currency value to use.
     */
    public static string $defaultCurrency = 'GBP';

    /**
     * Create the instance of Copper.
     *
     * @param  float|string|null  $value  Number to be used in the formatter.
     * @param  int|null  $style  Style of formatter to use.
     * @param  string|null  $locale  Locale to use for the formatter.
     * @return Copper Copper instance.
     */
    public static function create(float|string|null $value = null, ?int $style = null, ?string $locale = null): Copper
    {
        if (! self::$instance instanceof self) {
            self::$instance = new self;
        }

        if (false === is_null($value)) {
            self::$value = (float) $value;
        }
        if (false === is_null($locale)) {
            self::$locale = $locale;
        }
        if (false === is_null($style)) {
            self::$style = $style;
        }

        self::$formatter = new NumberFormatter(self::$locale, self::$style);

        return self::$instance;
    }

    /**
     * Format the number using DECIMAL.
     *
     * @param  int|null  $precision  Precision to use for formatter.
     * @return string|bool Formatted number.
     */
    public static function decimal(?int $precision = null): string|bool
    {
        if (NumberFormatter::DECIMAL !== self::$style) {
            self::setStyle(NumberFormatter::DECIMAL);
        }
        if (false === is_null($precision)) {
            self::$formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        }

        return self::$formatter->format(self::$value);
    }

    /**
     * Format the number using CURRENCY.
     *
     * @param  string  $iso  The 3-letter ISO 4217 currency code indicating the currency to use.
     * @return string|bool Formatted number.
     */
    public static function currency(string $iso): string|bool
    {
        if (NumberFormatter::CURRENCY !== self::$style) {
            self::setStyle(NumberFormatter::CURRENCY);
        }

        return self::$formatter->formatCurrency(self::$value, $iso);
    }

    /**
     * Format the number using SPELLOUT.
     *
     * @return string|bool Formatted number.
     */
    public static function spellOut(): string|bool
    {
        if (NumberFormatter::SPELLOUT !== self::$style) {
            self::setStyle(NumberFormatter::SPELLOUT);
        }

        return self::$formatter->format(self::$value);
    }

    /**
     * Format the number using PERCENT.
     *
     * @return string|bool Formatted number.
     */
    public static function percentage(): string|bool
    {
        if (NumberFormatter::PERCENT !== self::$style) {
            self::setStyle(NumberFormatter::PERCENT);
        }

        return self::$formatter->format(self::$value);
    }

    /**
     * Format the number using CURRENCY_ACCOUNTING.
     *
     * @param  string  $iso  The 3-letter ISO 4217 currency code indicating the currency to use.
     * @return string|bool Formatted number.
     */
    public static function accounting(string $iso): string|bool
    {
        if (NumberFormatter::CURRENCY_ACCOUNTING !== self::$style) {
            self::setStyle(NumberFormatter::CURRENCY_ACCOUNTING);
        }

        return self::$formatter->formatCurrency(self::$value, $iso);
    }

    /**
     * Format the number using SCIENTIFIC.
     *
     * @return string|bool Formatted number.
     */
    public static function scientific(): string|bool
    {
        if (NumberFormatter::SCIENTIFIC !== self::$style) {
            self::setStyle(NumberFormatter::SCIENTIFIC);
        }

        return self::$formatter->format(self::$value);
    }

    /**
     * Format the number using SI units and prefixes.
     *
     * @param  Unit  $unit  SI Unit to display using.
     *
     * @parm bool $usePrefix Set whether to use prefixes.
     *
     * @param  bool  $useThrees  Set whether to use only multiples of three in prefixes.
     * @param  int|null  $precision  Set the precision of the number.
     * @return string Formatted number.
     */
    public static function unit(Unit $unit, bool $usePrefix = true, bool $useThrees = true, ?int $precision = null): string
    {
        if (NumberFormatter::DECIMAL !== self::$style) {
            self::setStyle(NumberFormatter::DECIMAL);
        }
        if (false === is_null($precision)) {
            self::$formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        }

        $value = self::$value;
        $exponent = 0;

        if ($usePrefix) {
            $exponent = (int) (floor(log10(abs($value))));

            if ($useThrees || $exponent >= 3) {
                $options = [
                    (int) floor($exponent / 3) * 3,
                    (int) ceil($exponent / 3) * 3,
                ];
                $exponent =
                    abs($exponent - $options[0]) < abs($options[1] - $exponent)
                        ? $options[0]
                        : $options[1];
            }

            $value /= (10 ** $exponent);
        }

        return self::$formatter->format($value).' '.Prefix::from($exponent)->symbol().$unit->value;
    }

    /**
     * Set the Locale.
     *
     * @param  string  $locale  Locale in which the number would be formatted.
     * @return ?Copper Copper instance.
     */
    public static function setLocale(string $locale): ?Copper
    {
        self::$locale = $locale;
        self::create();

        return self::$instance;
    }

    /**
     * Get the Locale.
     *
     * @return string Locale being used by the instance.
     */
    public static function getLocale(): string
    {
        return self::$locale;
    }

    /**
     * Set the Style.
     *
     * @param  int  $style  Style of the formatting.
     * @return ?Copper Copper instance.
     */
    public static function setStyle(int $style): ?Copper
    {
        self::$style = $style;
        self::create();

        return self::$instance;
    }

    /**
     * Get the Style.
     *
     * @return int Style being used by the instance.
     */
    public static function getStyle(): int
    {
        return self::$style;
    }
}
