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
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Events\EventDispatcher;

/**
 * A simple API extension for NumberFormatter.
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Service provider boot loader.
     */
    public function boot(): void
    {
        $this->updateLocale();

        if (false === $this->app->bound('events')) {
            return;
        }

        $service = $this;
        $events = $this->app['events'];

        if (true === $this->isEventDispatcher($events)) {
            $events->listen(
                (class_exists(\Illuminate\Foundation\Events\LocaleUpdated::class)) ? \Illuminate\Foundation\Events\LocaleUpdated::class : 'locale.changed',
                function () use ($service): void {
                    $service->updateLocale();
                }
            );
        }
    }

    /**
     * Function to update the locale used by Copper.
     */
    public function updateLocale(): void
    {
        $app = $this->app;
        $locale = $app->getLocale();
        Copper::setLocale($locale);
    }

    /**
     * Registration function for Laravel <5.3.
     */
    public function register(): void
    {
        // Needed for Laravel < 5.3 compatibility
    }

    /**
     * Check function for Event Dispatcher.
     *
     * @param  Illuminate\Contracts\Events\Dispatcher|Illuminate\Events\Dispatcher|Illuminate\Events\EventDispatcher  $instance  Event dispatcher
     */
    protected function isEventDispatcher($instance): bool
    {
        return $instance instanceof EventDispatcher
            || $instance instanceof Dispatcher
            || $instance instanceof DispatcherContract;
    }
}
