<?php
use Illuminate\Support\Str;

function upload_image($uploded_image,$name)
{

    // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max size

    if ($uploded_image->hasFile('image')) {
        $image = $uploded_image->file('image');
        $name_slug = Str::slug($name, '_');

        $imageName = time() . '_' . $name_slug . '.' .$image->getClientOriginalExtension();

        // Move the image to the 'public/images' directory
        $image->move(public_path('images'), $imageName);

        // Return the file path relative to the public directory
        return 'images/' . $imageName;
    }

    return null;
}




?>


