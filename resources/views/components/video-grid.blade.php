@props(['videos'])

@if($videos->count()>1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach($videos->skip(0) as $video)
            <x-video-card
                :video="$video"
                {{-- class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}" --}}
            />
        @endforeach
    </div>
@endif
