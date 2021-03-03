<?php

namespace App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AlbumUpload
{
    public static function uploadImg($url, $img) {
        $filename = $url . '-' .str::random(4). md5(date('Y-M-D H:i:s')) . '.' . $img->extension();
        $photo = Image::make($img);
        $store = Storage::disk('public');

        // $photo->orientate()->encode();
        // $store->put($url. '/original/'. $filename, $photo);
        $photoMedium = $photo->resize(750,390)->orientate()->encode();
        $store->put($url. '/album/' . $filename, $photoMedium);

        return $filename;
    }


    public static function destroyFile($url, $img) {
        $mediumPath = $url. '/album/'. $img;
        if (file_exists($mediumPath)) {
            Storage::disk('public')->delete($mediumPath);
        }
    }
}