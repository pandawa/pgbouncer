<?php

declare(strict_types=1);

namespace Pandawa\PgBouncer;

use DateTimeInterface;
use Illuminate\Database\PostgresConnection;
use PDO;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class PgBouncerConnection extends PostgresConnection
{
    public function prepareBindings(array $bindings)
    {
        $grammar = $this->getQueryGrammar();

        foreach ($bindings as $key => $value) {
            // We need to transform all instances of DateTimeInterface into the actual
            // date string. Each query grammar maintains its own date string format
            // so we'll just ask the grammar for the format to get from the date.
            if ($value instanceof DateTimeInterface) {
                $bindings[$key] = $value->format($grammar->getDateFormat());
            } elseif (is_bool($value)) {
                $bindings[$key] = $value ? 'true' : 'false';
            }
        }

        return $bindings;
    }
}
