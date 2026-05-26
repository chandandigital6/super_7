<!DOCTYPE html>
<html lang="hi-IN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

   @php
    $siteName = 'super-7-satta';

    $metaTitle = $seo->meta_title ?? 'Today A7 Satta King Result – March 2026 Live Chart';

    $metaDescription = $seo->meta_description
        ?? 'Get live Super A7 Satta King result today 2026 at Super 7 Satta. Fast and accurate result updates.';

    $metaKeywords = $seo->meta_keywords
        ?? 'super A7 satta, super A7 satta king, 7 satta king, a7 satta, a7 satta king, a7 satta result';

    $canonicalUrl = $seo->canonical_url ?? url()->current();

    $ogTitle = $seo->og_title ?? $metaTitle;

    $ogDescription = $seo->og_description ?? $metaDescription;

    $ogImage = !empty($seo->og_image)
        ? asset($seo->og_image)
        : asset('Logo(2).png');
@endphp

<title>{{ $metaTitle }}</title>

<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="robots" content="index, follow">

<link rel="canonical" href="{{ $canonicalUrl }}">

<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="en_IN">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ $ogImage }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $ogTitle }}">
<meta name="twitter:description" content="{{ $ogDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('j/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('j/apple-touch-icon.png') }}">


    <link rel="stylesheet" href="{{ asset('next/static/css/b357a2dcbca59595.css') }}">
    <link rel="stylesheet" href="{{ asset('next/static/css/1aae1bcfa6b95e00.css') }}">


    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2QEDR9PH55"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2QEDR9PH55');
  
  
</script>
</head>

<body class="w-full min-h-screen font-Roboto">
    <div id="app" class="w-full">
        @include('front.layouts.header')
        @include('front.layouts.nav')

        <main class="w-full py-4">
            @yield('content')
        </main>

        @include('front.layouts.footer')
        <div id="modal"></div>
    </div>
</body>

</html>



