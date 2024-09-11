<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

function upload_image($uploded_image, $name , $previous_image_path)
{
    if ($previous_image_path != null && File::exists(public_path($previous_image_path))) {
        File::delete(public_path($previous_image_path));
    }
    $image = $uploded_image;
    $name_slug = Str::slug($name, '_');

    $imageName = time() . '_' . $name_slug . '.' .$image->getClientOriginalExtension();
    $image->move(public_path('images'), $imageName);

    return 'images/' . $imageName;
}

?>


