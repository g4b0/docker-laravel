<?php

namespace App\Jobs;

use App\Models\LeadEmail;
use App\Models\LogbookRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DeduplicationByEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Logbook record to process
     *
     * @var App\Models\LogbookRecord
     */
    protected $logbookRecord;

    /**
     * Create a new job instance.
     *
     * @param LogbookRecord $logbookRecord
     * @return void
     */
    public function __construct(LogbookRecord $logbookRecord)
    {
        $this->logbookRecord = $logbookRecord;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!empty($this->logbookRecord->email)) {
            $leadEmail = LeadEmail::find($this->logbookRecord->email);
            if ($leadEmail === null) {
                // New record
                $leadEmail = new LeadEmail;
                $leadEmail->email=$this->logbookRecord->email;
                $leadEmail->first_name=$this->logbookRecord->first_name;
                $leadEmail->last_name=$this->logbookRecord->last_name;
                $leadEmail->telephone=$this->logbookRecord->telephone;
                $leadEmail->privacy=$this->logbookRecord->privacy;
                $leadEmail->privacy_marketing=$this->logbookRecord->privacy_marketing;
                $leadEmail->privacy_third_party=$this->logbookRecord->privacy_third_party;
            } else {
                // Update record
                if (!empty($this->logbookRecord->first_name)) {
                    $leadEmail->first_name=$this->logbookRecord->first_name;
                }
                if (!empty($this->logbookRecord->last_name)) {
                    $leadEmail->last_name=$this->logbookRecord->last_name;
                }
                if (!empty($this->logbookRecord->telephone)) {
                    $leadEmail->telephone=$this->logbookRecord->telephone;
                }
                $leadEmail->privacy = ($leadEmail->privacy || $this->logbookRecord->privacy) ? true : false;
                $leadEmail->privacy_marketing = ($leadEmail->privacy_marketing || $this->logbookRecord->privacy_marketing) ? true : false;
                $leadEmail->privacy_third_party = ($leadEmail->privacy_third_party || $this->logbookRecord->privacy_third_party) ? true : false;
            }

            $leadEmail->save();
        }
        
    }
}
