@props(['video', 'mime', 'url', 'visibility'])

<x-layout title="{{ $video->title }} / VidMS / Simple Video CMS" :description="$video->description">
    <x-slot name="head">
        @vite(['resources/js/vidstack.js'])
    </x-slot>
    <section class="my-12">
        <span class="badge badge-primary">{{ $visibility }}</span>
        <span class="badge badge-primary">{{ $mime }}</span>
        <h1 class="text-4xl text-content1 my-2 flex items-center gap-2">
            {{ $video->title }}
            <span class="badge badge-outline text-base px-4 rounded-lg">
                {{ $video->slug }}
            </span>
        </h1>
        <p class="text-content2">{{ $video->description ?? 'No description provided' }}</p>
    </section>

    <video controls>
        <source src="{{ $url }}" type="{{ $mime }}" />
    </video>

    <section class="my-6">
        <h2 class="text-3xl">Details</h2>
        <div class="flex w-full overflow-x-auto">
            <div class="flex w-full overflow-x-auto">
                <table class="table-compact table max-w-4xl">
                    <tbody>
                        <tr>
                            <th>Title</th>
                            <td>{{ $video->title }}</td>
                        </tr>
                        <tr>
                            <th>Visiblity</th>
                            <td>{{ $visibility }}</td>
                        </tr>
                        <tr>
                            <th>Mime</th>
                            <td>{{ $mime }}</td>
                        </tr>
                        <tr>
                            <th>Storage Url</th>
                            <td><a href="{{ $url }}">{{ $url }}</a></td>
                        </tr>
                        <tr>
                            <th>Streaming Url</th>
                            <td><a href="/stream/{{ $video->slug }}">/stream/{{ $video->slug }}</a></td>
                        </tr>
                        <tr>
                            <th>Download Url</th>
                            <td><a href="/download/{{ $video->slug }}">/download/{{ $video->slug }}</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <form method="post" action="/delete" class="my-6">
            @csrf
            <input type="hidden" name="slug" value="{{ $video->slug }}" />
            <input type="submit" value="Delete" class="btn btn-error" />
        </form>
    </section>
</x-layout>
