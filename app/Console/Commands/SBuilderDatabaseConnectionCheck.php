<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SBuilderDatabaseConnectionCheck extends Command
{
    protected $signature = 'sbuilder:db-check';

    public function handle() : int
    {
        try {
            DB::connection('mysql-sbuilder')->getPdo();
        } catch (Exception $e) {
            $this->components->error($e->getMessage());

            return self::FAILURE;
        }

        $this->components->info('Connect to database is OK!');

        DB::connection('mysql-sbuilder')->disconnect();

        return self::SUCCESS;
    }
}