<?php

namespace App\Models;

use App\Models\Landing;
use App\Models\Logbook;
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
    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }
}
