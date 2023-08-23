@props(['title' => 'VidMS', 'description' => 'Video CMS Service following KISS principle', 'imageUrl' => '', 'nextUrl' => '', 'prevUrl' => ''])

<meta charset="utf-8" />
<link rel="sitemap" href="/sitemap-index.xml" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="generator" content="Laravel 10" />
<!-- basic meta -->
<meta name="description" content="{{ $description }}" />
<meta name="keywords" content="vidms, upload, video, cdn" />
<meta name="canonical" content="" />
<meta name="robots" content="index, follow" />
<meta name="author" content="Timo Beckmann" />
<meta name="publisher" content="Timo Beckmann" />

@if($nextUrl != '')
<link rel="next" href="{{ $nextUrl }}" />
@endif
@if($prevUrl != '')
<link rel="prev" href="{{ $prevUrl }}" />
@endif

<!-- open graph (facebook) -->
<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ $description }}" />
@if($imageUrl != '')
<meta property="og:image" content="{{ $imageUrl }}" />
@endif
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="VidMS" />
<!-- twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ $title }}" />
<meta name="twitter:description" content="{{ $description }}" />
@if($imageUrl != '')
<meta name="twitter:image" content="{{ $imageUrl }}" />
@endif
<!-- <meta name="twitter:site" content="" />
<meta name="twitter:creator" content="" /> -->
