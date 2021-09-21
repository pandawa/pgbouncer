<?php

declare(strict_types=1);

namespace Pandawa\PgBouncer;

use Illuminate\Database\Connection;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class PandawaPgBouncerModule extends AbstractModule
{
    protected function init(): void
    {
        Connection::resolverFor('pgsql', function ($connection, $database, $prefix, $config) {
            return new PostgresConnection($connection, $database, $prefix, $config);
        });
    }
}
