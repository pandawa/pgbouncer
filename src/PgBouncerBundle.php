<?php

declare(strict_types=1);

namespace Pandawa\PgBouncer;

use Illuminate\Database\Connection;
use Illuminate\Database\PostgresConnection;
use Pandawa\Component\Foundation\Bundle\Bundle;
use PDO;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class PgBouncerBundle extends Bundle
{
    public function configure(): void
    {
        Connection::resolverFor('pgsql', function ($connection, $database, $prefix, $config) {
            if (in_array(PDO::ATTR_EMULATE_PREPARES, $config['options'] ?? [])) {
                return new PgBouncerConnection($connection, $database, $prefix, $config);
            }

            return new PostgresConnection($connection, $database, $prefix, $config);
        });
    }
}
