@props(['video'])

<div class="card card-image-cover">
	<img src="https://source.unsplash.com/random/300x200" alt="" />
	<div class="card-body">
		<h2 class="card-header">{{ $video->title }}</h2>
		<p class="text-content2">{{ $video->description ?? 'No description' }}</p>
		<div class="card-footer">
			<a class="btn-primary btn" href="/view/{{ $video->slug }}">Watch</a>
		</div>
	</div>
</div>
