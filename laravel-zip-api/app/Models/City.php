<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

    public function zipCodes() {
        return $this->hasMany(ZipCode::class);
    }
}
