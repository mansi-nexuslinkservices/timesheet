<?php
namespace App\Helpers;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Str;

class Helper {

    public static function InsertImage($file,$path){
        $fileOriginal = $file->getClientOriginalName();
        $fName = Str::slug(pathinfo($fileOriginal, PATHINFO_FILENAME));
        $extension = pathinfo($fileOriginal, PATHINFO_EXTENSION);

        $filename = date('YmdHi-').$fName.'.'.$extension;

        $file->move(public_path($path), $filename);
        return $filename;
    }

	public static function ThumbnailImage($filename,$file_path,$thumbImagePath, $width = "", $height = ""){
        if(!File::isDirectory($thumbImagePath)){
            File::makeDirectory($thumbImagePath, 0777, true, true);
        }
        $img = Image::make($file_path);
        $imgPath = $thumbImagePath.DIRECTORY_SEPARATOR.$filename;
        if(empty($width)){
            $width = config('app.profile_thumb_img_width'); // your max width
        }
        if(empty($height)){
            $height = config('app.profile_thumb_img_height'); // your max height
        }
        $img->orientate()->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        })->save($imgPath);
    }
}

?>