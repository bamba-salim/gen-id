<?php

namespace App\Console\Commands;

use App\Http\Utils\DataBaseConstants;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean app';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (DataBaseConstants::ARTISAN_TO_CLEAR as $item) {
            Artisan::call("$item:clear");
        }
        $final = join(', ', DataBaseConstants::ARTISAN_TO_CLEAR);

        $this->comment(strtoupper("[$final] have been cleared SUCCESSFULLY !"));
        return 1;
    }
}
