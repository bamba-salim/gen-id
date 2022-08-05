<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogsClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all log files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        exec('rm -f ' . storage_path('logs/*.log'));
        exec('rm -f ' . base_path('*.log'));

        $this->comment('Logs have been cleared!');
        return 0;
    }
}
