<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Gallery;
use App\Http\Requests\GalleryRequest;
use File;
use Session;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
            $gallery = new Gallery;
            Gallery::save_image($gallery,$request); 
            Session::flash("notice", "Gallery success created");
            return redirect()->route("galleries.index");
        
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
            $gallery = Gallery::find($id);
            //delete file
            Gallery::delete_files($gallery);

            //save image
            Gallery::save_image($gallery,$request);
            Session::flash("notice", "Gallery success updated");
            return redirect()->route("galleries.show", $id);
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
