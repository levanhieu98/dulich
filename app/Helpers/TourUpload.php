<?php

namespace App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class TourUpload
{
    public static function uploadImg($url, $img) {
        $filename = $url . '-' . md5(date('Y-M-D H:i:s')) . '.' . $img->extension();
        $photo = Image::make($img);
        $store = Storage::disk('public');

        $photo->orientate()->encode();
        $store->put($url. '/original/'. $filename, $photo);

        $photoMedium = $photo->resize(500, 500)->orientate()->encode();
        $store->put($url. '/medium/' . $filename, $photoMedium);

        return $filename;
    }


    public static function destroyFile($url, $img) {
        $originalPath =$url. '/original/'. $img;
        $mediumPath = $url. '/medium/'. $img;
        if (file_exists($originalPath) && file_exists($mediumPath)) {
            Storage::disk('public')->delete($originalPath);
            Storage::disk('public')->delete($mediumPath);
        }
    }
}