<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateForceReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:reset:force';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tableList = DB::select('SHOW TABLES');

        Schema::enableForeignKeyConstraints();
        foreach ($tableList as $table) Schema::drop($table->Tables_in_gen_id);
        Schema::disableForeignKeyConstraints();

        return 0;
    }
}
