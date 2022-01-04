<?php

namespace App\Models;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogbookRecord extends Model
{
    use HasFactory;

    protected $table = 'logbook';

    /**
     * Get the logbook campaigns
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
