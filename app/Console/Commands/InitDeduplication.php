<?php

namespace App\Console\Commands;

use App\Models\LeadEmail;
use App\Models\LogbookRecord;
use Illuminate\Console\Command;
use App\Jobs\DeduplicationByEmail;

class InitDeduplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deduplication:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the deduplication process';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Init deduplication');

        LeadEmail::truncate();
        LogbookRecord::orderBy('id')
            ->chunk(50, function ($logbookRecords) {
            foreach ($logbookRecords as $logbookRecord) {
                DeduplicationByEmail::dispatch($logbookRecord);
            }
        });

        $this->info('Finish deduplication');

        return 0;
    }
}
