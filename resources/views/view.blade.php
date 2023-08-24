@props(['video', 'url', 'visibility'])

<x-layout title="{{ $video->title }} / VidMS / Simple Video CMS" :description="$video->description">
    <x-slot name="head">
        @vite(['resources/js/vidstack.js'])
    </x-slot>
    <section class="my-12">
        <span class="badge badge-primary">{{ $visibility }}</span>
        <h1 class="text-4xl text-content1 mb-2">{{ $video->title }}</h1>
        <p class="text-content2">{{ $video->description }}</p>
    </section>
    <media-player
        title="Sprite Fight"
        src="/video/{{ $video->slug }}"
        poster="https://image.mux.com/VZtzUzGRv02OhRnZCxcNg49OilvolTqdnFLEqBsTwaxU/thumbnail.webp?time=268&width=980"
        thumbnails="https://media-files.vidstack.io/sprite-fight/thumbnails.vtt"
        aspect-ratio="16/9"
        crossorigin
    >
        <media-outlet>
            <media-poster
                alt="Girl walks into sprite gnomes around her friend on a campfire in danger!"
            ></media-poster>
            <track
                src="https://media-files.vidstack.io/sprite-fight/subs/english.vtt"
                label="English"
                srclang="en-US"
                kind="subtitles"
                default
            />
            <track
                src="https://media-files.vidstack.io/sprite-fight/chapters.vtt"
                srclang="en-US"
                kind="chapters"
                default
            />
        </media-outlet>
        <media-community-skin></media-community-skin>
    </media-player>
</x-layout>
