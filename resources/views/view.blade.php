@props(['video'])

<x-layout title="View Video">
    <h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>
</x-layout>
