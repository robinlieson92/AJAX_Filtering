<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Gallery;
use App\Http\Requests\GalleryRequest;
use Validator;
use File;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries=Gallery::all();
        return view('galleries.index')
        ->with('galleries', $galleries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.create');
    }

    public static function save_image($gallery, $req)
    {
        $gallery->title = $req->input('title');
        $gallery->description = $req->input('description');
        
        $image = $req->file('urlimage');
        
        if ($req->file('urlimage')->isValid() )
            {
                $path = $req->urlimage->path(); 
                $imagename = $image->getClientOriginalName();
                //$file->move('public/uploads', $file->getClientOriginalName());

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $validation = Validator::make($request->all(), [
            'title'     => 'required',
            'urlimage'  => 'required|image|mimes:jpeg,png,jpg|max:200'
            ]);
        if ($validation->fails() ){
            return redirect()->back()->withInput()
                             ->with('errors',$validation->errors() );
        }
        else {
            $gallery = new Gallery;
            GalleriesController::save_image($gallery,$request); 
            Session::flash("notice", "Gallery success created");
            return redirect()->route("galleries.index");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $galleries = Gallery::find($id);
        return view('galleries.show')
        ->with('gallery', $galleries);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galleries = Gallery::find($id);
        return view('galleries.edit')
        ->with('gallery', $galleries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'title'     => 'required',
            'urlimage'  => 'required|image|mimes:jpeg,png,jpg|max:200'
            ]);
        if ($validation->fails() ){
            return redirect()->back()->withInput()
                             ->with('errors',$validation->errors() );
        }
        else{
            $gallery = Gallery::find($id);
            //delete file
            $path1 = public_path()."/upload_image/".$gallery->id."/".$gallery->url;
            $path2 = public_path()."/upload_image/".$gallery->id."/".$gallery->showimage;
            $path3 = public_path()."/upload_image/".$gallery->id."/".$gallery->thumbnail;
            
            File::delete($path1);
            File::delete($path2);
            File::delete($path3);

            //save image
            GalleriesController::save_image($gallery,$request);
            Session::flash("notice", "Gallery success updated");
            return redirect()->route("galleries.show", $id);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $directory = public_path()."/upload_image/".$id;
        File::deleteDirectory($directory);
        Gallery::destroy($id);
        Session::flash("notice", "Gallery success deleted");
        return redirect()->route("galleries.index");
    }
}
