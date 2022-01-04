<?php

namespace App\Models;

use App\Models\Landing;
use App\Models\LogbookRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    /**
     * Get the campaign landing
     */
    public function landing()
    {
        return $this->belongsTo(Landing::class);
    }

    /**
     * Get the campaign users
     */
    public function logbookRecords()
    {
        return $this->hasMany(LogbookRecord::class);
    }
}
