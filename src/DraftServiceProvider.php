<?php

namespace Icekristal\LaravelDraft;

use Icekristal\LaravelDraft\Services\IceDraftService;
use Illuminate\Support\ServiceProvider;

class DraftServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind('ice.draft', IceDraftService::class);
        $this->registerConfig();
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfigs();
            $this->publishMigrations();
        }
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/draft.php', 'draft');
    }


    protected function publishMigrations(): void
    {
        if (!class_exists('CreateDraftsTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_drafts_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_drafts_table.php'),
            ], 'migrations');
        }
    }

    protected function publishConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/../config/draft.php' => config_path('draft.php'),
        ], 'config');
    }

}
