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

namespace Copper\Laravel;

use Copper\Copper;
use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

/**
 * A simple API extension for NumberFormatter.
 */
class CopperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->updateLocale();

        Event::listen(LocaleUpdated::class, fn ($event) => $this->updateLocale());
    }

    public function updateLocale(): void
    {
        $app = $this->app;
        $locale = $app->getLocale();
        Copper::setLocale($locale);
    }
}
