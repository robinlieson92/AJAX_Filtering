<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File,DB;
use Intervention\Image\ImageManagerStatic as Image;

class Gallery extends Model
{
	public static function save_image($gallery, $req)
    {
        $gallery->title = $req->input('title');
        $gallery->description = $req->input('description');
        
        $image = $req->file('urlimage');
        
        if ($req->file('urlimage')->isValid() )
            {
                $path = $req->urlimage->path(); 
                $imagename = $image->getClientOriginalName();

                $gallery->url ="ori_".$imagename;
                $gallery->thumbnail ="thumb_".$imagename;
                $gallery->showimage ="show_".$imagename;
                $gallery->save();
                $directory = public_path()."/upload_image/".$gallery->id;

                if(!File::exists($directory)){
                    File::makeDirectory($directory,$mode=0777,true,true);
                }
                Image::make($image)->save($directory."/ori_".$imagename);
                Image::make($image)->resize('200','100')->save($directory."/thumb_".$imagename);
                Image::make($image)->resize('600','300')->save($directory."/show_".$imagename);
            }
    }

    public static function delete_files($gallery)
    {
    	$path1 = public_path()."/upload_image/".$gallery->id."/".$gallery->url;
        $path2 = public_path()."/upload_image/".$gallery->id."/".$gallery->showimage;
        $path3 = public_path()."/upload_image/".$gallery->id."/".$gallery->thumbnail;
        
        File::delete($path1);
        File::delete($path2);
        File::delete($path3);
    }
}
