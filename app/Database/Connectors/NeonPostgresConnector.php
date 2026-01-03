<?php

namespace App\Database\Connectors;

use Illuminate\Database\Connectors\PostgresConnector as BasePostgresConnector;
use PDO;

class NeonPostgresConnector extends BasePostgresConnector
{
    /**
     * Create a DSN string from a configuration.
     */
    protected function getDsn(array $config): string
    {
        $host = $config['host'] ?? '';
        $database = $config['database'] ?? '';
        $port = $config['port'] ?? 5432;
        
        $dsn = "pgsql:host={$host};port={$port};dbname={$database}";
        
        // Adiciona o endpoint para o Neon
        if (!empty($config['endpoint'])) {
            $dsn .= ";options='endpoint={$config['endpoint']}'";
        }
        
        if (isset($config['sslmode'])) {
            $dsn .= ";sslmode={$config['sslmode']}";
        }

        return $this->addSslOptions($dsn, $config);
    }
}
