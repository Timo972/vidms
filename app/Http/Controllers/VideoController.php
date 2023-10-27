<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    static $VALID_MIME_TYPES = [
        'video/mp4',
        'video/webm',
        'video/3gp',
        'video/ogg',
        'video/avi',
        'video/mpeg',
        // apple only
        'video/quicktime'
    ];

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
                'video' => 'Invalid video file',
            ]);
        }

        if (!in_array($file->getMimeType(), VideoController::$VALID_MIME_TYPES)) {
            return redirect()->back()->withErrors([
                'video' => "Unsupported video format: {$file->getMimeType()}",
            ]);
        }

        $name = $request->input('name');
        $title = $request->input('title');
        $desc = $request->input('description');

        // save file to default storage
        $filePath = Storage::putFile('videos', $file, 'public');

        if (!$filePath) {
            return redirect()->back()->withErrors([
                'video' => 'Failed to store video',
            ]);
        }

        $video = Video::create([
            'slug' => Str::slug($name ?? $file->getClientOriginalName()),
            'path' => $filePath,
            'title' => $title ?? $file->getClientOriginalName(),
            'description' => $desc ?? 'No description',
        ]);
        $video->save();

        return redirect("/view/{$video->slug}");
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

    public function view(string $slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();

        $url = Storage::url($video->path);
        $mime = Storage::mimeType($video->path);

        return view('view', ['video' => $video, 'url' => $url, 'visibility' => 'public', 'mime' => $mime]);
    }

    public function download(string $slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();

        if (!Storage::exists($video->path)) {
            abort(404);
        }

        return Storage::download($video->path);
    }
}
