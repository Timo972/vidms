<x-layout title="Upload to VidMS / Simple Video CMS">
    <section class="my-12">
        <h1 class="text-4xl text-content1 mb-2">Upload your video</h1>
        <p class="text-content2">Select a video from your local drive</p>
    </section>
    <form class="flex flex-col gap-y-4 bg-gray-2 rounded-xl p-8" method="POST" action="/upload">
        @csrf
        <input type="file" class="input-file input-file-lg input-file-primary" />
        <input type="text" class="input input-block input-lg focus:input-primary" placeholder="video-name" />
        <input type="password" class="input input-block input-lg focus:input-primary" placeholder="password" />
        <div class="flex flex-row justify-between">
            <input type="reset" class="btn btn-lg btn-outline" value="Reset" />
            <input type="submit" class="btn btn-lg btn-outline-primary" value="Upload" />
        </div>
    </form>
</x-layout>
