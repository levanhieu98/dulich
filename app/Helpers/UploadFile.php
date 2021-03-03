<?php

namespace App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public static function uploadImg($img, $str) {
        $filename = $str . '-' . md5(date('Y-M-D H:i:s')) . '.' . $img->extension();
        $photo = Image::make($img);
        $store = Storage::disk('public');

        $photo->orientate()->encode();
        $store->put($str. '/original/'. $filename, $photo);

        $photoMedium = $photo->resize(360, 225)->orientate()->encode();
        $store->put($str. '/medium/' . $filename, $photoMedium);

        return $filename;
    }


    public static function destroyFile($img, $str) {
        $originalPath = $str. '/original/'. $img;
        $mediumPath = $str. '/medium/'. $img;
        if (file_exists($originalPath) && file_exists($mediumPath)) {
            Storage::disk('public')->delete($originalPath);
            Storage::disk('public')->delete($mediumPath);
        }
    }
}
