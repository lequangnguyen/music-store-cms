<?php

namespace App\Services;


use Illuminate\Http\Request;

interface ImageServicesInterface
{
    public function createThumbnail($path, $width, $height);

}
