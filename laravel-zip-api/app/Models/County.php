<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable = ['zip', 'name', 'county_id'];

    public function county() {
        return $this->belongsTo(County::class);
    }
}
