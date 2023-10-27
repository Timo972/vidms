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

    protected function renderView(Video $video)
    {
        $url = Storage::url($video->path);
        $mime = Storage::mimeType($video->path);
        return view('view', ['video' => $video, 'url' => $url, 'visibility' => 'public', 'mime' => $mime]);
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

        return VideoController::renderView($video);
    }

    public function stream(string $slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();

        if (!Storage::exists($video->path)) {
            abort(404);
        }

        $stream = Storage::readStream($video->path);

        // von hier an raw php, weil laravel keine docs darüber hat

        // set content type to video mime format
        header('Content-Type: ' . Storage::mimeType($video->path));
        // set browser cache
        header("Cache-Control: max-age=2592000, public");

        $bytesRead = 0;
        $chunkSize = 1024 * 1024 * 10; // 10MB
        $size = Storage::size($video->path);
        $streamEnd = $size - 1;

        // this is unnecessary for this example. wont support starting at a specific time
        // set accept range size
        // header("Accept-Ranges: 0-" . $streamEnd);

        // set video size
        header('Content-Length: ' . $size);

        // stream video

        // solange stream nicht zu ende ist und noch nicht alle bytes gelesen wurden
        while (!feof($stream) && $bytesRead < $size - 1) {
            if (($bytesRead + $chunkSize) > $streamEnd) {
                // wenn chunk größer als streamEnde, dann chunkSize auf streamEnde setzen, sodass nicht mehr als streamEnde gelesen wird
                $chunkSize = $streamEnd - $bytesRead + 1;
            }

            // read chunk
            $data = fread($stream, $chunkSize);
            echo $data;
            // chunk zum browser senden
            flush();
            // bytes read erhöhen
            $bytesRead += $chunkSize;
        }

        /*return response()->stream(function () use ($stream) {
            fpassthru($stream);
        }, 200, [
            'Content-Type' => Storage::mimeType($video->path),
            'Content-Length' => Storage::size($video->path),
            'Content-Disposition' => 'inline; filename="' . $video->title . '"',
        ]);*/

        // close stream when done
        fclose($stream);
        exit;
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
