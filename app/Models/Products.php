<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    protected $fillable = [
    ];
    public $timestamps = false;
    public function category()
    {
        $this->belongTo(Categories::class);
    }


}
