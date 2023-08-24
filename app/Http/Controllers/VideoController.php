<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('video')) {
            return redirect()->back()->withErrors([
                'video' => 'Please select a video to upload',
            ]);
        }

        $file = $request->file('video');

        if (!$file->isValid()) {
            return redirect()->back()->withErrors([
                'video' => 'Invalid video',
            ]);
        }

        $name = $request->input('name');
        $secret = $request->input('secret');
        $title = $request->input('title');
        $desc = $request->input('description');
        $filePath = $file->store('videos');

        $video = Video::create([
            'slug' => Str::slug($name ?? $file->getClientOriginalName()),
            'path' => $filePath,
            'title' => $title ?? $file->getClientOriginalName(),
            'description' => $desc,
        ]);
        $video->save();

        return view('view', ['video' => $video]);
    }

    public function index(Request $request)
    {
        return view('index', ['videos' => Video::all()]);
    }

    public function view(string $slug) {
        return view('view', ['video' => Video::where('slug', $slug)->firstOrFail()]);
    }
}
