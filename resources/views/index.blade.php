@props(['videos'])
<x-layout title="VidMS / Simple Video CMS">
    <section class="my-12">
        <h1 class="text-4xl text-content1 mb-2">Uploaded Videos</h1>
        <p class="text-content2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea sed ipsam dolorum totam tempora voluptate <br /> quae voluptatum explicabo praesentium similique quod consectetur, velit tenetur.</p>
    </section>
    <x-video-grid :videos="$videos" />
</x-layout>
