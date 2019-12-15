<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
    ];
    public $timestamps = true;
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
