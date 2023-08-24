<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function upload(Request $request)
    {
        dd($request);
        dd($request->file('video'));
        $filePath = $request->file('video')->store('videos');

        $video = Video::create([
            'slug' => str_slug($filePath),
            'path' => $filePath,
        ]);
        $video->save();

        return view('upload.success');
    }

    public function index(Request $request)
    {
        return view('index', ['videos' => Video::all()]);
    }
}
