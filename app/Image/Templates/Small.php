<?php

namespace App\Image\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(120, 90);
    }
}
