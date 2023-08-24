<x-layout title="Upload to VidMS / Simple Video CMS">
    <section class="my-12">
        <h1 class="text-4xl text-content1 mb-2">Upload your video</h1>
        <p class="text-content2">Select a video from your local drive</p>
    </section>
    <form class="flex flex-col gap-y-4 bg-gray-2 rounded-xl p-8" method="POST" action="/upload" enctype="multipart/form-data">
        @foreach($errors->all() as $error)
            <div class="alert alert-error">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM24 26C22.9 26 22 25.1 22 24V16C22 14.9 22.9 14 24 14C25.1 14 26 14.9 26 16V24C26 25.1 25.1 26 24 26ZM26 34H22V30H26V34Z" fill="#E92C2C" />
                </svg>
                <div class="flex flex-col">
                    <span class="text-content2">{{ $error }}</span>
                </div>
            </div>
        @endforeach
        @csrf
        <input type="file" name="video" class="input-file input-file-lg input-file-primary" />
        <input type="text" name="name" class="input input-block input-lg focus:input-primary" placeholder="video-name" />
        <input type="password" name="secret" class="input input-block input-lg focus:input-primary" placeholder="password" />
        <div class="flex flex-row justify-between">
            <input type="reset" class="btn btn-lg btn-outline" value="Reset" />
            <input type="submit" class="btn btn-lg btn-outline-primary" value="Upload" />
        </div>
    </form>
</x-layout>
