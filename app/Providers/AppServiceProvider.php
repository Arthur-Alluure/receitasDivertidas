<?php

namespace App\Providers;

use App\Database\Connectors\NeonPostgresConnector;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registra o connector customizado para Neon
        $this->app->bind('db.connector.pgsql', function ($app) {
            return new NeonPostgresConnector();
        });

        // Registra o Repository Pattern
        $this->app->bind(
            \App\Repositories\ReceitaRepositoryInterface::class,
            \App\Repositories\ReceitaRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Desabilita prepared statements para evitar cache de planos no PostgreSQL
        if (config('database.default') === 'pgsql') {
            \DB::connection()->getPdo()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
        }
    }
}
