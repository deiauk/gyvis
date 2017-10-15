<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }
    public function create()
    {
        $this->validate(request(), [
            "file" => "required|max:10000|mimes:jpeg,jpg,png"
        ]);

        if (request()->hasFile('file')) {
            $destinationPath = public_path() . '/uploads/gallery';
            $file = request()->file('file');

            $newName = uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($destinationPath, $newName);
        }

        Gallery::create([
            'filename' => $newName
        ]);

        return $this->index();
        //return view('gallery.index', compact('galleries'));
    }
    public function delete(Gallery $gallery)
    {
        @unlink(public_path() . '/uploads/gallery/' . $gallery->filename);
        $gallery->delete();
        return response()->json([], 202);
        //return view('gallery.index', compact('galleries'));
    }
}
