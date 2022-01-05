<?php

namespace Vo1\Seat\Sms;

use Seat\Services\AbstractSeatPlugin;

class SmsServiceProvider extends AbstractSeatPlugin
{
    public function boot()
    {
        $this->addRoutes();
        $this->addViews();
        $this->addTranslations();

        $this->addMigrations();
    }

    /**
     * Include the routes.
     */
    public function addRoutes()
    {
        if (!$this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }

    public function addTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'alerts');
    }

    public function addViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'alerts');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/sms.config.php', 'awox.config');
        $this->mergeConfigFrom(__DIR__ . '/Config/sms.sidebar.php', 'package.sidebar');
        $this->registerPermissions(__DIR__ . '/Config/sms.permissions.php', 'awox');
    }

    private function addMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
    }

    public function getName(): string
    {
        return 'AwoxFinder';
    }

    public function getPackageRepositoryUrl(): string
    {
        return 'https://github.com/vo1/seat-sms';
    }

    public function getPackagistPackageName(): string
    {
        return 'vo1/seat-sms';
    }

    public function getPackagistVendorName(): string
    {
        return 'vo1';
    }
}