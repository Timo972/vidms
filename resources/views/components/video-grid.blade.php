@props(['videos'])

<p class="mb-2">Total uploaded videos: {{ $videos->count() }}</p>

@if($videos->count()>0)
    <div class="lg:grid lg:grid-cols-3 lg:gap-4">
        @foreach($videos->skip(0) as $video)
            <x-video-card
                :video="$video"
                {{-- class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}" --}}
            />
        @endforeach
    </div>
@endif
