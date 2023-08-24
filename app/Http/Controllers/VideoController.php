<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    protected function renderView(Video $video) {
        $url = Storage::url($video->path);
        $visiblity = Storage::getVisibility($video->path);
        return view('view', ['video' => $video, 'url' => $url, 'visibility' => $visiblity]);
    }

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

        // stream upload file to storage
        $filePath = null;
        if ($secret) {
            $filePath = $file->store('videos');
        } else {
            $filePath = $file->storePublicly('videos');
        }

        $video = Video::create([
            'slug' => Str::slug($name ?? $file->getClientOriginalName()),
            'path' => $filePath,
            'title' => $title ?? $file->getClientOriginalName(),
            'description' => $desc,
        ]);
        $video->save();

        return VideoController::renderView($video);
    }

    public function delete(Request $request)
    {
        $video = Video::where('slug', $request->input('slug'))->firstOrFail();
        $video->delete();
        Storage::delete($video->path);
        return redirect()->route('index');
    }

    public function index(Request $request)
    {
        return view('index', ['videos' => Video::all()]);
    }

    public function view(string $slug) {
        $video = Video::where('slug', $slug)->firstOrFail();

        return VideoController::renderView($video);
    }
}
