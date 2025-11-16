<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImage extends Controller
{
    public function upload(Request $request)
    {
        // echo $request->file('file')->getClientOriginalExtension();

        $request->validate([
            'file' => 'required|image|max:2048', // Max size 2MB
        ]);

        $path = $request->file('file')->store('images', 'public');

        return back()->with('success', 'Image uploaded successfully!')->with('path', $path);
    }

    public function showForm()
    {
        return view('upload');
    }   

    public function ListImages()
    {
        $files = Storage::files('public/images');
        return view('list_images', ['files' => $files]);
    }
}
