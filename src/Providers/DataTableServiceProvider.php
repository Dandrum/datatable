<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Providers;

use Illuminate\Support\ServiceProvider;

final class DataTableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/dataTable.php', 'dataTable');

        // Load default translations
        $this->loadJsonTranslationsFrom(__DIR__.'/../../resources/lang');

        // Override if Published
        $this->loadJsonTranslationsFrom($this->app->langPath('vendor/dataTable'));

        // Load Views
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'dataTable');

        // Console Commands
        $this->consoleCommands();
    }

    public function consoleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../resources/lang' => $this->app->langPath('vendor/dataTable'),
            ], 'dataTable-translations');

            $this->publishes([
                __DIR__.'/../../config/dataTable.php' => config_path('dataTable.php'),
            ], 'dataTable-config');

            $this->publishes([
                __DIR__.'/../../resources/views' => $this->app->resourcePath('views/vendor/dataTable'),
            ], 'dataTable-views');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/dataTable.php', 'dataTable'
        );
    }
}
