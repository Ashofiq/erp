<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Termwind\{render};
use function Termwind\{ask};
use Auth;
class TransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'total_transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Total Transaction';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $phone = $this->ask('Enter your phone number?' , false);

        render("<div class='bg-green-500'>Your Phone Number Is : {$phone}</div>");
        return 0;
    }
}
