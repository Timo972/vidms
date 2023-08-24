@props(['video'])

<x-layout title="{{ $video->title }} / VidMS / Simple Video CMS" :description="$video->description">
    <section class="my-12">
        <h1 class="text-4xl text-content1 mb-2">{{ $video->title }}</h1>
        <p class="text-content2">{{ $video->description }}</p>
    </section>
</x-layout>
