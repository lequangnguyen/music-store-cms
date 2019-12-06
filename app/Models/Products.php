<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'category_id',
        'main_picture',
        'sub_picture1',
        'sub_picture2',
        'sub_picture3',
    ];
    public $timestamps = false;
    public function category()
    {
        $this->belongTo(Categories::class);
    }


}
