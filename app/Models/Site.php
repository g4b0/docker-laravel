<?php

namespace App\Models;

use App\Models\Landing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;
 
    /**
     * Get the site landings
     */
    public function landings()
    {
        return $this->hasMany(Landing::class);
    }
}
