<?php

namespace App\Models;

use App\Models\Site;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Landing extends Model
{
    use HasFactory;

    /**
     * Get the landing site
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * Get the site campaigns
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
