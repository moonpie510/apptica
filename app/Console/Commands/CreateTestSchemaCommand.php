<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateTestSchemaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:create-schema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает БД для тестов';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::statement('CREATE DATABASE apptica_test');
        $this->info('База данных apptica_test для тестов создана');
    }
}
