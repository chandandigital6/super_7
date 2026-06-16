<!DOCTYPE html>
<html lang="hi-IN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            : asset('Logo(2).webp');
    @endphp

    <title>{{ $metaTitle }}</title>

    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0aa485">

    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="hi_IN">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $ogImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('j/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('j/apple-touch-icon.png') }}">

    <link rel="preconnect" href="{{ url('/') }}" crossorigin>

    <link rel="preload"
          href="{{ asset('fonts/Roboto.woff2') }}"
          as="font"
          type="font/woff2"
          crossorigin>

    <link rel="preload"
          href="{{ asset('fonts/RobotoBold.woff2') }}"
          as="font"
          type="font/woff2"
          crossorigin>

    <link rel="preload"
          href="{{ asset('Logo(2).webp') }}"
          as="image"
          fetchpriority="high">

    {{-- CLS fix: CSS ko preload async mat rakho, warna page pehle unstyled load hota hai --}}
    <link rel="stylesheet" href="{{ asset('next/static/css/b357a2dcbca59595.css') }}">
    <link rel="stylesheet" href="{{ asset('next/static/css/1aae1bcfa6b95e00.css') }}">

    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('{{ asset('fonts/Roboto.woff2') }}') format('woff2');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('{{ asset('fonts/RobotoBold.woff2') }}') format('woff2');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        html {
            scroll-behavior: smooth;
            text-size-adjust: 100%;
        }

        body {
            margin: 0;
            width: 100%;
            min-height: 100vh;
            font-family: 'Roboto', Arial, sans-serif;
            background: #ffffff;
            color: #111827;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        a {
            text-decoration-thickness: 1px;
            text-underline-offset: 2px;
        }

        #app {
            width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
        }

        main {
            min-height: 400px;
        }

        .lazy {
            content-visibility: auto;
        }
    </style>

    @if(!empty($seo?->schema_markup))
        {!! $seo->schema_markup !!}
    @endif
</head>

<body>
    <div id="app">
        @include('front.layouts.header')
        @include('front.layouts.nav')

        <main class="w-full py-4">
            @yield('content')
        </main>

        @include('front.layouts.footer')

        <div id="modal"></div>
    </div>

    {{-- GTM ko page load ke baad load karaya hai. Isse unused JS / main thread issue kam hoga --}}
    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                var s = document.createElement('script');
                s.src = 'https://www.googletagmanager.com/gtag/js?id=G-2QEDR9PH55';
                s.async = true;
                document.head.appendChild(s);

                window.dataLayer = window.dataLayer || [];
                function gtag(){ dataLayer.push(arguments); }
                window.gtag = gtag;

                gtag('js', new Date());
                gtag('config', 'G-2QEDR9PH55', {
                    'send_page_view': true
                });
            }, 2500);
        });
    </script>

    @stack('scripts')
</body>

</html>