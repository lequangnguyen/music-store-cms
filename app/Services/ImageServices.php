<?php

namespace App\Services;
use Intervention\Image\Facades\Image;

class ImageServices implements ImageServicesInterface
{

    public function createThumbnail($path, $width, $height)
    {
        // TODO: Implement createThumbnail() method.
        $img = Image::make($path)->resize($width, $height)->save($path);
    }
}
