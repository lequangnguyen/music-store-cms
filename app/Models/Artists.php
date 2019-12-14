<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    public $timestamps = false;
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
