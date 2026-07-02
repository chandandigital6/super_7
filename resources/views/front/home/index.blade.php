@extends('front.layouts.app', [
    'seo' => $seo ?? null,
])

@section('content')
    @php
        $topAdvertisement = $advertisements->where('position', 'top')->first();
        $middleAdvertisement = $advertisements->where('position', 'middle')->first();
        $bottomAdvertisement = $advertisements->where('position', 'bottom')->first();

        $currentYear = now('Asia/Kolkata')->year;
        $years = [
            $currentYear,
            $currentYear - 1,
            $currentYear - 2,
        ];

        $gameSections = $games->chunk(17);
        $chartGameSections = $chartGames->chunk(15);
    @endphp

  
<style>
    .rv-page {
        width: 100%;
        overflow-x: hidden;
        background: #fff;
    }

    .rv-hero-title {
        padding: 16px 10px;
        text-align: center;
        background: #ffffff;
    }

    .rv-hero-title h1 {
        margin: 0;
        font-size: 24px;
        line-height: 1.25;
        font-weight: 800;
        text-transform: uppercase;
        color: #111827;
    }

    /* =========================
       ADVERTISEMENT FIX START
    ========================= */
    .rv-ad-wrap {
        width: 100%;
        margin: 12px auto;
        font-family: Arial, 'Noto Sans Devanagari', sans-serif;
        contain: layout paint;
    }

    .rv-ad-box {
        min-height: 112px;
        background: linear-gradient(180deg, #ffd900 0%, #fff8cf 100%);
        border: 3px dashed #e60000;
        border-radius: 16px;
        padding: 12px 10px;
        text-align: center;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .10);
    }

    .rv-ad-box,
    .rv-ad-box * {
        color: #111 !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        line-height: 1.45 !important;
        word-break: break-word;
    }

    .rv-ad-box h1,
    .rv-ad-box h2,
    .rv-ad-box h3,
    .rv-ad-box h4,
    .rv-ad-box h5,
    .rv-ad-box h6,
    .rv-ad-box p {
        margin: 4px 0 !important;
        font-size: 16px !important;
    }

    .rv-ad-box > div:not(.addb-content) {
        margin: 4px 0 !important;
        font-size: 16px !important;
    }

    .addb-content {
        display: block !important;
        width: 100% !important;
        text-align: center !important;
        white-space: pre-line !important;
        margin: 0 auto !important;
    }

    .addb-content p,
    .addb-content div {
        display: block !important;
        margin: 4px 0 !important;
        padding: 0 !important;
        text-align: center !important;
        white-space: pre-line !important;
    }

    .addb-content br {
        display: block !important;
        content: "" !important;
        margin: 0 !important;
        line-height: 1.2 !important;
    }

    .addb-content strong,
    .addb-content b {
        font-weight: 900 !important;
    }

    .addb-content ul,
    .addb-content ol {
        display: inline-block !important;
        margin: 4px auto !important;
        padding-left: 20px !important;
        text-align: left !important;
    }

    .addb-content li {
        margin: 2px 0 !important;
        white-space: normal !important;
    }

    .rv-ad-title {
        font-size: 18px !important;
        font-weight: 800 !important;
    }

    .rv-ad-name {
        font-size: 19px !important;
        font-weight: 900 !important;
        color: #b42318 !important;
    }

    .rv-ad-img {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 58px;
        max-width: 100%;
        margin-top: 8px;
        padding: 5px 12px;
        background: #fff;
        border-radius: 999px;
    }

    .rv-ad-img img {
        width: auto;
        height: auto;
        max-height: 55px;
        max-width: 220px;
        object-fit: contain;
    }

    .rv-middle {
        background: linear-gradient(180deg, #111827, #1f2937);
        border: 3px dashed #ffd900;
    }

    .rv-middle,
    .rv-middle * {
        color: #fff !important;
    }
    /* =========================
       ADVERTISEMENT FIX END
    ========================= */

    .rv-game-header {
        display: flex;
        align-items: center;
        justify-content: space-around;
        gap: 16px;
        background: #facc15;
    }

    .rv-game-header-title {
        width: 100%;
        padding: 12px;
        background: #581c87;
        color: #ffffff;
        font-weight: 800;
    }

    .rv-game-header-result {
        display: flex;
        width: 75%;
        align-items: center;
        justify-content: space-around;
        background: #facc15;
    }

    .rv-game-card {
        display: flex;
        align-items: center;
        justify-content: space-around;
        gap: 16px;
        border: 1px solid #111827;
        min-height: 94px;
    }

    .rv-game-name {
        padding-bottom: 8px;
        font-size: 20px;
        line-height: 1.25;
        font-weight: 800;
        letter-spacing: .02em;
        text-transform: uppercase;
        text-align: start;
        color: #111827;
    }

    .rv-game-name a {
        color: #111827;
        text-decoration: none;
    }

    .rv-game-name a:hover {
        text-decoration: underline;
    }

    .rv-game-time {
        color: #7f1d1d;
        font-size: 14px;
        font-weight: 700;
    }

    .rv-chart-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #facc15;
        padding: 6px 12px;
        color: #000;
        font-size: 12px;
        font-weight: 900;
        text-decoration: none;
        box-shadow: 0 1px 3px rgba(0,0,0,.15);
    }

    .rv-chart-btn:hover {
        background: #fde047;
        text-decoration: none;
    }

    .rv-result-col {
        display: flex;
        width: 75%;
        align-items: center;
        justify-content: space-around;
    }

    .rv-result-text {
        min-width: 42px;
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        line-height: 1;
        font-weight: 600;
        letter-spacing: .08em;
        color: #111827;
    }

    .waitimg {
        display: inline-flex;
        width: 42px;
        height: 42px;
        align-items: center;
        justify-content: center;
    }

    .rv-year-box {
        margin-top: 16px;
        padding: 32px 8px;
        background: #4b5563;
    }

    .rv-year-box h2 {
        margin: 0 0 16px;
        text-align: center;
        color: #fff;
        font-size: 24px;
        line-height: 1.3;
        font-weight: 800;
    }

    .rv-year-form {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .rv-year-selects {
        display: flex;
        gap: 6px;
    }

    .rv-year-selects select {
        border-radius: 8px;
        background: #fff;
        padding: 10px 8px;
        font-size: 14px;
        outline: none;
        color: #111827;
    }

    .rv-year-button {
        border: 2px solid #eab308;
        border-radius: 10px;
        background: #facc15;
        padding: 10px 20px;
        color: #000;
        font-weight: 900;
        text-transform: uppercase;
        cursor: pointer;
    }

    .rv-year-button:hover {
        background: #eab308;
    }

    .rv-monthly-section {
        width: 100%;
        margin-top: 24px;
        padding: 0 8px;
        content-visibility: auto;
        contain-intrinsic-size: 900px;
    }

    .rv-chart-wrapper {
        margin-bottom: 32px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .10);
    }

    .rv-table-scroll {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .rv-chart-table {
        width: 100%;
        min-width: max-content;
        border-collapse: separate;
        border-spacing: 3px;
        text-align: center;
    }

    .rv-chart-table th {
        background: #007f68;
        color: #ffffff;
    }

    .rv-chart-table td {
        background: #243f49;
        color: #ffffff;
    }

    .rv-chart-table th,
    .rv-chart-table td {
        padding: 12px;
        border-radius: 8px;
        font-weight: 800;
    }

    .rv-chart-table .rv-date-cell {
        position: sticky;
        left: 0;
        z-index: 10;
        min-width: 115px;
    }

    .rv-chart-table thead .rv-date-cell {
        z-index: 20;
    }

    .rv-chart-table .rv-game-cell {
        min-width: 100px;
        white-space: normal;
        font-size: 13px;
        line-height: 1.3;
    }

    .homeContent {
        background: #ffffff;
        content-visibility: auto;
        contain-intrinsic-size: 1600px;
    }

    .homeContent .rv-content-wrap {
        padding: 0 10px 16px;
    }

    .homeContent h2,
    .homeContent h3 {
        margin: 16px 0 0;
        padding: 16px 20px;
        background: #31586b;
        text-align: center;
        color: #fff;
        font-weight: 800;
        line-height: 1.35;
    }

    .homeContent h2 {
        font-size: 19px;
    }

    .homeContent h3 {
        font-size: 17px;
    }

    .homeContent .answer,
    .homeContent .rv-text {
        padding: 10px;
        color: #111827;
        line-height: 1.65;
        font-size: 16px;
    }

    .homeContent a {
        color: #0047ff;
        text-decoration: underline;
        font-weight: 700;
    }

    @media(max-width:640px) {
        .rv-hero-title h1 {
            font-size: 20px;
        }

        .rv-ad-wrap {
            margin: 10px auto;
        }

        .rv-ad-box {
            min-height: 104px;
            border-width: 3px;
            border-radius: 14px;
            padding: 10px 8px;
        }

        .rv-ad-box,
        .rv-ad-box * {
            font-size: 14px !important;
            line-height: 1.4 !important;
        }

        .addb-content,
        .addb-content p,
        .addb-content div {
            white-space: pre-line !important;
        }

        .rv-ad-title {
            font-size: 15px !important;
        }

        .rv-ad-name {
            font-size: 16px !important;
        }

        .rv-ad-img {
            min-height: 52px;
            padding: 4px 10px;
            margin-top: 6px;
        }

        .rv-ad-img img {
            max-height: 48px;
            max-width: 190px;
        }

        .rv-game-card {
            gap: 8px;
            min-height: 90px;
        }

        .rv-game-name {
            font-size: 18px;
        }

        .rv-result-text {
            font-size: 22px;
        }

        .rv-year-box h2 {
            font-size: 20px;
        }

        .rv-year-selects select {
            max-width: 160px;
            font-size: 13px;
        }

        .rv-year-button {
            padding: 9px 16px;
            font-size: 13px;
        }

        .homeContent h2 {
            font-size: 17px;
            padding: 14px 10px;
        }

        .homeContent h3 {
            font-size: 15px;
            padding: 12px 10px;
        }

        .homeContent .answer,
        .homeContent .rv-text {
            font-size: 15px;
        }
    }
</style>

    <div class="rv-page">

        <section class="rv-hero-title">
            <h1>Super A7 Satta King Result Today – Updated Live Instantly</h1>
        </section>

        {{-- Top Advertisement --}}
        @if ($topAdvertisement)
            <section class="rv-ad-wrap" aria-label="Top Advertisement">
                <div class="rv-ad-box">
                    @if (!empty($topAdvertisement->content))
                        <div class="addb-content">
                            {!! $topAdvertisement->content !!}
                        </div>
                    @endif

                    @if (!empty($topAdvertisement->image))
                        @if (!empty($topAdvertisement->link))
                            <a href="{{ $topAdvertisement->link }}" target="_blank" rel="noopener nofollow" style="text-decoration:none;">
                                <span class="rv-ad-img">
                                    <img src="{{ asset('storage/' . $topAdvertisement->image) }}"
                                         alt="{{ $topAdvertisement->title ?? 'Advertisement' }}"
                                         width="139"
                                         height="48"
                                         loading="eager"
                                         decoding="async"
                                         fetchpriority="high">
                                </span>
                            </a>
                        @else
                            <span class="rv-ad-img">
                                <img src="{{ asset('storage/' . $topAdvertisement->image) }}"
                                     alt="{{ $topAdvertisement->title ?? 'Advertisement' }}"
                                     width="139"
                                     height="48"
                                     loading="eager"
                                     decoding="async"
                                     fetchpriority="high">
                            </span>
                        @endif
                    @endif
                </div>
            </section>
        @else
            <section class="rv-ad-wrap" aria-label="Top Advertisement">
                <div class="rv-ad-box">
                    <h2 class="rv-ad-title">नमस्कार साथियों</h2>

                    <p>
                        सीधा कंपनी खाईवाल के पास गेम प्ले करे<br>
                        बिंदास 1001% पेमेंट की गारंटी के साथ<br>
                        आपका अपना भाई
                    </p>

                    <h2 class="rv-ad-name">S.K BHAI</h2>

                    <span class="rv-ad-img">
                        <img src="{{ asset('Wp.png') }}"
                             alt="S.K Bhai"
                             width="139"
                             height="48"
                             loading="eager"
                             decoding="async"
                             fetchpriority="high">
                    </span>
                </div>
            </section>
        @endif

        {{-- Middle Advertisement --}}
        @if ($middleAdvertisement)
            <section class="rv-ad-wrap" aria-label="Middle Advertisement">
                <div class="rv-ad-box rv-middle">
                    @if (!empty($middleAdvertisement->content))
                        <div class="addb-content">
                            {!! $middleAdvertisement->content !!}
                        </div>
                    @endif

                    @if (!empty($middleAdvertisement->image))
                        @if (!empty($middleAdvertisement->link))
                            <a href="{{ $middleAdvertisement->link }}" target="_blank" rel="noopener nofollow" style="text-decoration:none;">
                                <span class="rv-ad-img">
                                    <img src="{{ asset('storage/' . $middleAdvertisement->image) }}"
                                         alt="{{ $middleAdvertisement->title ?? 'Advertisement' }}"
                                         width="159"
                                         height="55"
                                         loading="lazy"
                                         decoding="async">
                                </span>
                            </a>
                        @else
                            <span class="rv-ad-img">
                                <img src="{{ asset('storage/' . $middleAdvertisement->image) }}"
                                     alt="{{ $middleAdvertisement->title ?? 'Advertisement' }}"
                                     width="159"
                                     height="55"
                                     loading="lazy"
                                     decoding="async">
                            </span>
                        @endif
                    @endif
                </div>
            </section>
        @else
            <section class="rv-ad-wrap" aria-label="Middle Advertisement">
                <div class="rv-ad-box rv-middle">
                    <h2>
                        व्हाट्सएप पर सुपर फास्ट रिजल्ट देखने के लिए नीचे दिए गए लिंक पर जाएं और चैनल को फॉलो करें।
                    </h2>

                    <a href="https://whatsapp.com/channel/0029Vb67katLikgE57Pwhj0T" target="_blank" rel="noopener nofollow" style="text-decoration:none;">
                        <span class="rv-ad-img">
                            <img src="{{ asset('Join-WhatsApp.png') }}"
                                 alt="Join WhatsApp"
                                 width="159"
                                 height="55"
                                 loading="lazy"
                                 decoding="async">
                        </span>
                    </a>
                </div>
            </section>
        @endif

        {{-- Bottom Advertisement --}}
        @if ($bottomAdvertisement)
            <section class="rv-ad-wrap" aria-label="Bottom Advertisement">
                <div class="rv-ad-box">
                    @if (!empty($bottomAdvertisement->content))
                        <div class="addb-content">
                            {!! $bottomAdvertisement->content !!}
                        </div>
                    @endif

                    @if (!empty($bottomAdvertisement->image))
                        @if (!empty($bottomAdvertisement->link))
                            <a href="{{ $bottomAdvertisement->link }}" target="_blank" rel="noopener nofollow" style="text-decoration:none;">
                                <span class="rv-ad-img">
                                    <img src="{{ asset('storage/' . $bottomAdvertisement->image) }}"
                                         alt="{{ $bottomAdvertisement->title ?? 'Advertisement' }}"
                                         width="139"
                                         height="48"
                                         loading="lazy"
                                         decoding="async">
                                </span>
                            </a>
                        @else
                            <span class="rv-ad-img">
                                <img src="{{ asset('storage/' . $bottomAdvertisement->image) }}"
                                     alt="{{ $bottomAdvertisement->title ?? 'Advertisement' }}"
                                     width="139"
                                     height="48"
                                     loading="lazy"
                                     decoding="async">
                            </span>
                        @endif
                    @endif
                </div>
            </section>
        @else
            <section class="rv-ad-wrap" aria-label="Bottom Advertisement">
                <div class="rv-ad-box">
                    <div class="rv-ad-title">सीधे सट्टा कंपनी का No 1 खाईवाल</div>

                    <div class="rv-ad-name">☆☆ ABHISHEK BHAI KHAIWAL ☆☆</div>

                    <div>
                        🎯 पालिका बाजार..1:20pm<br>
                        🎯 प्रयागराज........2:00pm<br>
                        🎯 दिल्लीबाजार ...3:00pm<br>
                        🎯 दिल्ली दरबार....3:30pm<br>
                        🎯 श्री गणेश........4:30 Pm<br>
                        🎯 रूप नगर..........5:10pm<br>
                        🎯 फरीदाबाद.......5:50 pm<br>
                        🎯 फतेहपुर..........7:10 pm<br>
                        🎯 गाजियाबाद......8:50 pm<br>
                        🎯 नोएडानाईट.....10:00 pm<br>
                        🎯 गली...............11:15pm<br>
                        🎯 दिसावर ..........3:00 am
                    </div>

                    <div>
                        जोड़ी रेट<br>
                        जोड़ी रेट 10-------960<br>
                        हरफ रेट 100-----960
                    </div>

                    <div class="rv-ad-name">☆☆ ABHISHEK BHAI KHAIWAL ☆☆</div>

                    <div style="color:#7e22ce!important;font-weight:800!important;">
                        Game Play करने के लिए नीचे लिंक पर क्लिक करे
                    </div>

                    <span class="rv-ad-img">
                        <img src="{{ asset('whatsAppChat.png') }}"
                             alt="ABHISHEK BHAI"
                             width="139"
                             height="48"
                             loading="lazy"
                             decoding="async">
                    </span>

                    <div>Click to chat</div>
                </div>
            </section>
        @endif

        {{-- Game List Section --}}
        <section aria-label="Game Result List">
            @foreach ($gameSections as $sectionIndex => $gameSection)
                <div class="{{ $sectionIndex > 0 ? 'mt-8' : '' }}">
                    <div class="rv-game-header">
                        <p class="rv-game-header-title">GAME</p>

                        <div class="rv-game-header-result">
                            <p class="text-lg font-semibold">कल</p>
                            <p class="text-lg font-semibold">आज</p>
                        </div>
                    </div>

                    <div class="w-full px-0 text-center">
                        <div class="grid grid-cols-1 bg-white md:grid-cols-2 lg:grid-cols-3">
                            @forelse($gameSection as $game)
                                <article class="rv-game-card">
                                    <div class="w-full p-3">
                                        <h2 class="rv-game-name">
                                            <a href="{{ route('game.record', $game->slug) }}">
                                                {{ $game->name }}
                                            </a>
                                        </h2>

                                        <div class="flex items-center justify-between gap-2">
                                            <p class="rv-game-time">
                                                @if (!empty($game->result_time))
                                                    {{ \Carbon\Carbon::parse($game->result_time)->format('h:i A') }}
                                                @endif
                                            </p>

                                            <a href="{{ route('game.yearRecord', [$game->slug, $currentYear]) }}"
                                               class="rv-chart-btn">
                                                View Chart
                                            </a>
                                        </div>
                                    </div>

                                    <div class="rv-result-col">
                                        <p class="rv-result-text">
                                            @if (!empty($game->yesterdayResult->result))
                                                {{ is_numeric($game->yesterdayResult->result) && $game->yesterdayResult->result <= 9
                                                    ? str_pad($game->yesterdayResult->result, 2, '0', STR_PAD_LEFT)
                                                    : $game->yesterdayResult->result }}
                                            @else
                                                XX
                                            @endif
                                        </p>

                                        <p class="rv-result-text">
                                            @if (!empty($game->todayResult->result) && in_array($game->todayResult->status ?? '', ['declared', 'published']))
                                                {{ is_numeric($game->todayResult->result) && $game->todayResult->result <= 9
                                                    ? str_pad($game->todayResult->result, 2, '0', STR_PAD_LEFT)
                                                    : $game->todayResult->result }}
                                            @else
                                                <strong class="waitimg">
                                                    <img alt="waiting"
                                                         src="{{ asset('tamplate/admin/upimages/d.gif') }}"
                                                         width="40"
                                                         height="40"
                                                         loading="lazy"
                                                         decoding="async">
                                                </strong>
                                            @endif
                                        </p>
                                    </div>
                                </article>
                            @empty
                                <div class="p-4 text-center">No result found</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

        {{-- Year Chart Selector --}}
        <section class="rv-year-box" aria-label="Check All Game Year Chart">
            <h2>Check All Game Year Chart</h2>

            <form method="get" action="#" onsubmit="return false;">
                <div class="rv-year-form">
                    <div class="rv-year-selects">
                        <select id="gameSelect" aria-label="Select Game">
                            @foreach ($chartGames as $game)
                                <option value="{{ $game->slug }}">
                                    {{ $game->name }}
                                </option>
                            @endforeach
                        </select>

                        <select id="yearSelect" aria-label="Select Year">
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" onclick="openYearChart()" class="rv-year-button">
                        Check Chart
                    </button>
                </div>
            </form>
        </section>

        {{-- Monthly Chart Result Section --}}
        <section class="rv-monthly-section" aria-label="Monthly Chart Result">
            @foreach ($chartGameSections as $sectionIndex => $gameSection)
                <div class="rv-chart-wrapper">
                    <div class="rv-table-scroll">
                        <table class="rv-chart-table">
                            <thead>
                                <tr>
                                    <th class="rv-date-cell">
                                        Date
                                    </th>

                                    @foreach ($gameSection as $game)
                                        <th class="rv-game-cell">
                                            {{ $game->name }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dates as $date)
                                    @php
                                        $dateKey = $date->format('Y-m-d');
                                        $dayResults = $monthlyResults->get($dateKey, collect())->keyBy('game_slug');
                                    @endphp

                                    <tr>
                                        <td class="rv-date-cell">
                                            {{ $date->format('d-m-Y') }}
                                        </td>

                                        @foreach ($gameSection as $game)
                                            @php
                                                $result = $dayResults->get($game->slug);
                                            @endphp

                                            <td class="rv-game-cell">
                                                @if (!empty($result?->result))
                                                    {{ str_pad($result->result, 2, '0', STR_PAD_LEFT) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </section>



        {{-- SEO Content --}}
<section class="homeContent container" aria-label="Super 7 Satta Information">
    <div class="rv-content-wrap">
        
        <h2 class="ql-align-center">A7 Satta: Your Go-To Spot for Live Results and Everyday Insights</h2>
        <div class="rv-text">
            If you follow Satta games, chances are you’ve come across <a href="/">A7 Satta</a> quite a bit lately. It has quickly become one of the most popular choices because it gives players fast access to fresh results, detailed charts, and all the information they actually need. Whether you’re looking for today’s <strong>A7 Satta King Result</strong> or just want to check past numbers, everything is right here in one clean place.
        </div>

        <h2 class="ql-align-center">What is A7 Satta Really About?</h2>
        <div class="rv-text">
            A7 Satta is a straightforward number game that keeps things exciting day after day. You pick a two-digit number between 00 and 99, and when the official result comes out at its fixed time, you know right away if you’ve won that round.
            <br><br>
            What makes it special is the consistency. On Super 7 Satta, results are posted the moment they’re declared. Newcomers find it easy to understand, while regular players love that they can trust the timing and accuracy. It’s not complicated — just good, reliable updates you can count on.
        </div>

        <h2 class="ql-align-center">Checking the A7 Satta Result</h2>
        <div class="rv-text">
            The <strong>A7 Satta Result</strong> is the highlight of the day — the one number everyone waits for. We update it instantly on this page as soon as it’s official, so you don’t have to keep switching tabs or sites.
            <br><br>
            You’ll always see today’s result right next to yesterday’s, making it simple to compare and follow the flow. A lot of people visit this page multiple times daily just for this section because it’s clear, fast, and trustworthy.
        </div>

        <h2 class="ql-align-center">Understanding A7 Satta King</h2>
        <div class="rv-text">
            In the Satta community, <strong>A7 Satta King</strong> is a respected title. It goes to the person (or the prediction) that hits the exact winning number for the day. Getting it right feels great, and you’ll often see players sharing their King moments with friends.
            <br><br>
            That’s why we put extra focus on these updates. Beyond just showing the number, we give you full charts and history so you can learn, spot patterns, and enjoy the game more. Whether you’re new or experienced, tracking A7 Satta King adds real value to your daily routine.
            <br><br>
            All in all, this page brings together live results, helpful charts, and easy navigation — everything you need to enjoy A7 Satta without stress or confusion. Bookmark it and you’ll always be up to date.
        </div>

        <h2 class="ql-align-center">Other Popular Markets You Can Follow Here</h2>
        <div class="rv-text">
            After getting comfortable with A7 Satta, most players like to explore the other strong markets we cover. Each one has its own timing and personality, but they all work together nicely on the same platform.
        </div>

        <h3 class="ql-align-center">Delhi Bazar Satta</h3>
        <div class="rv-text">
            Delhi Bazar is a lively daytime game with results usually out in the early afternoon. Many people check the <a href="https://super-7-satta.com/records/delhi-bazar">Delhi Bazar Result Chart</a> after A7 Satta because the timing fits well. We keep clean charts ready so you can track patterns easily.
        </div>

        <h3 class="ql-align-center">Shri Ganesh Satta</h3>
        <div class="rv-text">
            Shri Ganesh has a loyal following and runs in the mid-afternoon. It feels like a natural next step after A7 Satta. Our <a href="https://super-7-satta.com/records/shri-ganesh">Shri Ganesh Result Chart</a> updates are quick, and the full charts help you stay on top of things.
        </div>

        <h3 class="ql-align-center">Faridabad Satta</h3>
        <div class="rv-text">
            Faridabad is one of the most followed evening markets. Results generally come in the late afternoon or early evening. A lot of A7 Satta players also track <a href="https://super-7-satta.com/records/faridabad">Faridabad Result Chart</a> here because the charts and updates are reliable.
        </div>

        <h3 class="ql-align-center">Ghaziabad Satta</h3>
        <div class="rv-text">
            Ghaziabad brings evening energy with its consistent timing around 8–9 PM. It pairs really well with your A7 Satta routine. Get fast <a href="https://super-7-satta.com/records/gaziabad">Ghaziabad Result Today Chart</a> updates and complete charts without any hassle.
        </div>

        <h3 class="ql-align-center">Gali Satta</h3>
        <div class="rv-text">
            Gali is a classic late-night favorite. Many people make it part of their nightly routine after checking earlier markets. <a href="https://super-7-satta.com/records/gali">Gali Result Chart</a> is posted quickly, along with detailed historical charts.
        </div>

        <h3 class="ql-align-center">Desawar Satta</h3>
        <div class="rv-text">
            Desawar, often written as Deswar, closes the day (or starts the next) with its early morning result around 2–3 AM. It’s one of the most respected markets and many A7 Satta followers check it daily. We have instant <a href="https://super-7-satta.com/records/disawar">Desawar Result Today</a> and deep charts available.
            <br><br>
            All these markets are connected on one platform, so you can move between them effortlessly.
        </div>

        <h2 class="ql-align-center">Why So Many Players Stick With Super 7 Satta</h2>
        <div class="rv-text">
            • Results load fast on both mobile and desktop<br>
            • Clean, easy-to-read charts with months and years of history<br>
            • No login or registration needed for results<br>
            • Honest, up-to-date information you can actually trust
        </div>

        <h2 class="ql-align-center">FAQs — Super A7 Satta</h2>

        <h3 class="ql-align-center">What is A7 Satta?</h3>
        <div class="answer">
            It’s a popular daily number game where players predict two-digit results. We provide fast live updates, charts, and clear info so you can follow easily.
        </div>

        <h3 class="ql-align-center">How do I see today’s A7 Satta Result?</h3>
        <div class="answer">
            Just stay on this page. We update the A7 Satta Result immediately when it’s declared, with yesterday’s number shown side by side.
        </div>

        <h3 class="ql-align-center">What does A7 Satta King mean?</h3>
        <div class="answer">
            It’s the title for the winning prediction or player who hits the exact number of the day. We track and show A7 Satta King results clearly.
        </div>

        <h3 class="ql-align-center">How does A7 Satta compare to Delhi Bazar or others?</h3>
        <div class="answer">
            A7 Satta is our main focus, but markets like Delhi Bazar follow similar rules with different timings. You can follow everything here in one place.
        </div>

        <h3 class="ql-align-center">When is Shri Ganesh Result declared?</h3>
        <div class="answer">
            Usually in the afternoon. We update Shri Ganesh Result quickly with full charts.
        </div>

        <h3 class="ql-align-center">What time does Faridabad Result come?</h3>
        <div class="answer">
            Typically, late afternoon or early evening. Faridabad Result and charts are posted as soon as available.
        </div>

        <h3 class="ql-align-center">Do you cover Ghaziabad and Gali too?</h3>
        <div class="answer">
            Yes, both Ghaziabad Result and Gali Result are updated on time with complete records.
        </div>

        <h3 class="ql-align-center">When does Desawar Result come out?</h3>
        <div class="answer">
            Early morning (around 2–3 AM). Desawar Result is available right away.
        </div>

        <h3 class="ql-align-center">How old are the charts on this site?</h3>
        <div class="answer">
            Most go back to 2023 and earlier, covering A7 Satta and all major markets.
        </div>

        <h3 class="ql-align-center">Is this website only for results?</h3>
        <div class="answer">
            Yes. We focus on accurate results, charts, and helpful information for A7 Satta King and related games for entertainment and informational purposes only.
        </div>

    </div>
</section>



        {{-- SEO Content --}}

        {{-- <section class="homeContent container" aria-label="Super 7 Satta Information">
            <div class="rv-content-wrap">
                <h2 class="ql-align-center">Super A7 Satta – India's Most Trusted A7 Satta King Result Platform</h2>
                <div class="rv-text">
                    Welcome to Super 7 Satta — your daily source for A7 Satta results, charts, and live number updates. If you are
                    looking for today's result or want to browse past records, everything is available here in one place. This is
                    one of the most followed games in the satta world. Players visit daily because the result is declared every day,
                    the chart history is easy to access, and the format is simple to understand — whether you are new or have been
                    following satta games for years. Along with A7 Satta, you can also check the
                    <a href="https://super-7-satta.com/records/disawar">Desawar Result Today</a> updated on this platform daily.
                    <br>
                    On this website you will get:<br>
                    • Daily A7 Satta result — updated the moment it is declared<br>
                    • Full chart history — easy to read and navigate<br>
                    • Past records going back to 2023<br>
                    • Live updates for all major satta markets
                </div>

                <h2 class="ql-align-center">A7 Satta Result Today</h2>
                <div class="rv-text">
                    Thousands of players check the <a href="/">A7 Satta</a> result every single day.
                    Getting the number on time helps players stay updated and compare with previous outcomes. This page is updated
                    daily in a clean, organized format. No need to visit multiple websites — the latest result is right here as soon
                    as it is officially announced. Players who also follow
                    <a href="https://super-7-satta.com/records/delhi-bazar">Delhi Bazar Result Chart</a>
                    will find that update here as well, listed alongside A7 in the same table.
                </div>

                <h2 class="ql-align-center">Why This Platform is Popular</h2>
                <div class="rv-text">
                    Many satta result websites exist online, but Super 7 Satta stands out for a few clear reasons:<br>
                    • Daily Results — A fresh number is declared every day, keeping the game consistently active<br>
                    • Clear Chart History — Past results are presented in a clean, date-wise format<br>
                    • Wide Coverage — 25+ markets updated daily, all in one table<br>
                    • No Login Needed — Results and charts are fully accessible without signing up<br>
                    • Simple Format — Easy for both new visitors and long-time followers<br>
                    For players who also track the
                    <a href="https://super-7-satta.com/records/shri-ganesh">Shri Ganesh Result Chart</a>,
                    all records are available here without needing to switch between different websites.
                </div>

                <h2 class="ql-align-center">A7 Satta Chart & Past Records</h2>
                <div class="rv-text">
                    The chart is one of the most useful features on this platform. It is a complete date-by-date record of every
                    result declared for each market, going back to 2023. Daily results are listed in chronological order, with
                    monthly and yearly records available for every market in a clean table format. Many players refer to the chart
                    to verify old numbers or study historical data. Those who regularly follow the
                    <a href="https://super-7-satta.com/records/faridabad">Faridabad Result Chart</a>
                    can find its full chart history here as well. To access any chart, simply click View Chart next to the game on the
                    homepage — no extra steps required.
                </div>

                <h2 class="ql-align-center">A7 Satta King – What the Term Means</h2>
                <div class="rv-text">
                    The term A7 Satta King is widely used across the satta community in India. In the traditional Satta Matka
                    format, the declared number for a market determines the winner for that day. The player who correctly predicts
                    that number is informally referred to as the Satta King for that round. Super 7 Satta publishes these results as
                    soon as they are officially declared. The platform does not conduct games or accept bets — its only role is to
                    deliver accurate, timely result updates. Players tracking the
                    <a href="https://super-7-satta.com/records/gaziabad">Ghaziabad Result Today Chart</a>
                    will find the same reliable, on-time updates here.
                </div>

                <h2 class="ql-align-center">Live Updates – Always On Time</h2>
                <div class="rv-text">
                    No one wants to wait for a result. On Super 7 Satta, numbers go live within seconds of the official announcement
                    — whether you are checking on your phone or desktop. The layout is kept simple on purpose — today's live result
                    for every market, full chart history accessible with one click, and links to all related satta games in one
                    place. This makes it easy to stay updated without confusion or delay, no matter how many markets you follow. If
                    <a href="https://super-7-satta.com/records/gali">Gali Result Chart</a>
                    is part of your daily check, you will find it updated here the moment it is officially declared.
                </div>

                <h2 class="ql-align-center">Responsible Information</h2>
                <div class="rv-text">
                    All result data and charts published on this website are for informational and entertainment purposes only. This
                    platform does not promote, conduct, or facilitate gambling or betting of any kind. Satta-related activities may
                    be restricted or illegal in certain states in India. Visitors are advised to check local laws before accessing
                    this content. We are not responsible for any financial loss or legal consequences.
                </div>

                <h2 class="ql-align-center">Conclusion</h2>
                <div class="rv-text">
                    Super 7 Satta is a reliable daily destination for A7 Satta result updates, chart history, and live number
                    announcements. Whether you want today's result or need to look up a past number — it is all here, updated every
                    day without delay. Bookmark this page and come back daily so you never miss an update.
                </div>

                <h2 class="ql-align-center">FAQs — Super A7 Satta</h2>

                <h3 class="ql-align-center">Q1. What is Super 7 Satta and how does it connect to A7 Satta King?</h3>
                <div class="answer" id="faq-1">
                    If you've been searching for Satta King results and landed on super-7-satta.com, you already know what this
                    place is about. Super 7 Satta has been running as one of the more reliable spots to get A7 Satta King updates —
                    things like live results, old charts, and daily game numbers for markets like Disawar, Gali, Faridabad,
                    Ghaziabad, Delhi Bazaar, Palika Bazar, and others. Players in the community started calling it A7 Satta or Super
                    7 Satta interchangeably, and the name just stuck. It's not complicated — you open the site, results are right
                    there.
                </div>

                <h3 class="ql-align-center">What exactly is A7 Satta King? Where does the name 'A7' come from?</h3>
                <div class="answer" id="faq-2">
                    Honestly, there's no deep meaning behind it. 'A7' is just a term that caught on within the Satta player
                    community — people started associating it with fast, no-nonsense result sites, and Super-7-Satta.com became one
                    of the names people trust when they want Disawar, Gali, or Faridabad results without waiting around. It's grown
                    quite a bit over the past couple of years, mostly through word of mouth.
                </div>

                <h3 class="ql-align-center">How many games does Super 7 Satta cover every day?</h3>
                <div class="answer" id="faq-3">
                    More than 25 games, updated every single day. We're talking Disawar, Gali, Ghaziabad, Faridabad, Delhi Bazaar,
                    Palika Bazar — the ones everyone already knows — but also Prayagraj, Shri Ganesh, Roop Nagar, Gwalior, Fatehpur,
                    Alwar, Noida Night, Dwarka, Goa Night, Jeevan Shree, Delhi Matka, MeghaCity, Dehradun City, Aligarh Night,
                    Chatisgarh, Sadar Bazar, and a few more. Finding all these results on a single site is actually rare — most
                    platforms miss half these markets.
                </div>

                <h3 class="ql-align-center">How do I check today's A7 Satta King result on Super 7 Satta?</h3>
                <div class="answer" id="faq-4">
                    Just open super-7-satta.com. No login, no registration, no pop-ups asking you to sign up. The homepage has a
                    live result table showing yesterday's number and today's result for every game, side by side. As soon as a
                    result is officially declared, it goes up. That's it — nothing fancy about the process.
                </div>

                <h3 class="ql-align-center">What time does the Disawar result usually come on Super 7 Satta?</h3>
                <div class="answer" id="faq-5">
                    Disawar result comes out at around 2:00 AM in the night. Super 7 Satta posts it within seconds after the
                    official announcement — if you've been using the site for a while, you've probably noticed it's usually up
                    before most other sites even update. Disawar is one of those old-school markets that people have been following
                    for decades, so there's a lot of interest in it.
                </div>

                <h3 class="ql-align-center">Why does the result show 'waiting' for some games on Super 7 Satta?</h3>
                <div class="answer" id="faq-6">
                    That just means the result hasn't come out yet from the official source. The site only updates when the real
                    number is declared — it won't guess or post anything unofficial. Sometimes games get delayed for reasons on the
                    operator's side. If you see 'waiting' for longer than usual, try refreshing. Or better yet, join the WhatsApp or
                    Telegram channel — you'll get an alert the moment the result drops.
                </div>

                <h3 class="ql-align-center">Can I get Super 7 Satta results on WhatsApp or Telegram?</h3>
                <div class="answer" id="faq-7">
                    Yes, and many regular users actually prefer this over opening the website every time. Both the WhatsApp channel
                    and Telegram channel push result updates directly to your phone as soon as they're posted. You'll find the links
                    on the homepage. If you follow multiple markets, this saves a lot of time — results just come to you.
                </div>

                <h3 class="ql-align-center">What is a Satta King chart and how do I read the one on Super 7 Satta?</h3>
                <div class="answer" id="faq-8">
                    A chart is just a date-by-date record of past results for a game. Each row shows one date and the number that
                    was declared on that day. People use charts to study old results, spot patterns, or simply verify a past number.
                    On Super 7 Satta, charts are available from 2023 to 2026. Hit the 'View Chart' button on the homepage next to
                    any game and it opens right up — no extra steps.
                </div>

                <h3 class="ql-align-center">How do I check the yearly chart for Disawar or Gali on Super 7 Satta?</h3>
                <div class="answer" id="faq-9">
                    Two ways to do it. First option — scroll to the game in the list and click 'View Chart' directly. Second option
                    — go to the 'Check All Game Year Chart' section near the bottom of the homepage, choose the game name, pick a
                    year (2023, 2024, 2025, or 2026), and click 'Check Chart'. The full year's record loads up. Useful if you're
                    looking at a specific game's history in one go.
                </div>

                <h3 class="ql-align-center">Is the monthly chart updated every day?</h3>
                <div class="answer" id="faq-10">
                    Yes. After each game result comes in, the current month's chart is updated to include it. So whatever you see is
                    current. Older charts from past months and years are stored permanently on the site — you can go back and look
                    up results from 2023 just as easily as checking last week's numbers.
                </div>

                <h3 class="ql-align-center">Does Super 7 Satta have charts for Faridabad, Ghaziabad, and Shri Ganesh Satta?</h3>
                <div class="answer" id="faq-11">
                    Yes — charts for all of them are available. Faridabad, Ghaziabad, Shri Ganesh, Gali, Disawar, Delhi Bazaar,
                    Sadar Bazar — all covered with full monthly and yearly records. Click 'View Chart' next to the game you want
                    from the homepage and it'll pull up the complete history.
                </div>

                <h3 class="ql-align-center">What is Satta King and how does the number game work?</h3>
                <div class="answer" id="faq-12">
                    Satta King is a number-guessing game where you pick a two-digit number between 00 and 99. If the declared result
                    matches your number, you win. Different markets — like Gali, Disawar, Faridabad — announce results at different
                    times of the day and night. Super 7 Satta's role is only to publish those results once they're officially
                    declared. The platform doesn't run games, doesn't take bets, doesn't involve itself in any of that.
                </div>

                <h3 class="ql-align-center">Who is a Khaiwal in Satta King, and how do I find one through Super 7 Satta?</h3>
                <div class="answer" id="faq-13">
                    A Khaiwal is essentially a middleman — they collect your bet, pass it to the game operator, and then handle your
                    payout if you win. Super 7 Satta lists verified Khaiwal contacts on the homepage through WhatsApp. These are
                    people who work directly with the official game companies. If you want to place a bet, you reach out to them.
                    Super 7 Satta itself only shares result information — it has nothing to do with taking or managing bets.
                </div>

                <h3 class="ql-align-center">Is Satta King legal in India? What about Super 7 Satta's legal status?</h3>
                <div class="answer" id="faq-14">
                    Gambling laws in India differ from state to state. The main law is the Public Gambling Act of 1867, and most
                    states use it to restrict or ban Satta and number-based gambling. Whether something is legal for you depends on
                    your state. Super 7 Satta only publishes results — it's an informational website, not a gambling platform. Think
                    of it like a news site that reports scores. It doesn't conduct or promote any gambling. That said, anyone using
                    Satta platforms should look into what the rules say in their state.
                </div>

                <h3 class="ql-align-center">Is it safe to use super-7-satta.com? Will my data be shared?</h3>
                <div class="answer" id="faq-15">
                    The site is read-only — you're just looking at results and charts. No personal information is collected from
                    regular visitors. There's no sign-up wall for accessing results, so nothing is being stored about you in the
                    background. The site runs on ad sponsorship. If you want to read the full disclaimer, it's on the website.
                </div>

                <h3 class="ql-align-center">Are the results on Super 7 Satta accurate?</h3>
                <div class="answer" id="faq-16">
                    Results are sourced directly from official game operators and verified through Khaiwal networks. Super 7 Satta
                    has maintained a consistent record of accurate, timely updates across all the markets it covers. That said, when
                    there's a delay or error, it usually comes from the source operator's end — the platform can't control what
                    happens before the number is submitted. Errors that get flagged are corrected quickly.
                </div>

                <h3 class="ql-align-center">What makes Super 7 Satta better than other A7 Satta King websites?</h3>
                <div class="answer" id="faq-17">
                    A few things make a real difference. Coverage is wider — 25+ games daily is more than most competitors bother
                    with. Speed matters too — results go up in real time, and regular users have noted it beats other sites to the
                    post fairly often. The chart history is also more complete — year-wise records from 2023 to 2026 are available
                    for every game. On top of that, content is available in both Hindi and English, which opens it up to more users.
                </div>

                <h3 class="ql-align-center">Does Super 7 Satta cover all the games other A7 Satta King sites cover?</h3>
                <div class="answer" id="faq-18">
                    Yes, and beyond. Every game you'd find on a typical A7 Satta platform is here — Disawar, Gali, Faridabad,
                    Ghaziabad, Delhi Bazaar, Shri Ganesh, Sadar Bazar. But Super 7 Satta also covers Palika Bazar, Prayagraj, Roop
                    Nagar, Gwalior, Fatehpur, Alwar, Agra, Dwarka, Noida Night, Goa Night, Jeevan Shree, MeghaCity, Dehradun City,
                    Aligarh Night, Delhi Matka, and Chatisgarh. That's hard to match on a single platform.
                </div>

                <h3 class="ql-align-center">How do I bookmark Super 7 Satta on my mobile?</h3>
                <div class="answer" id="faq-19">
                    On Android with Chrome — open the site, tap the three-dot menu at the top right, and select 'Add to Home
                    Screen'. On iPhone with Safari — tap the Share icon at the bottom and pick 'Add to Home Screen'. A shortcut icon
                    appears on your phone's home screen and opens the site directly, like an app. No typing the URL every time.
                </div>

                <h3 class="ql-align-center">Does Super 7 Satta have a login? What is it used for?</h3>
                <div class="answer" id="faq-20">
                    There's a login on the site, but it's only for Khaiwal partners and verified game operators who submit results.
                    If you're a regular visitor checking results or browsing charts, you don't need an account. Everything —
                    results, charts, game lists — is visible without logging in.
                </div>

                <h3 class="ql-align-center">What should I do if a result is missing or incorrect on Super 7 Satta?</h3>
                <div class="answer" id="faq-21">
                    First thing — refresh the page. If the result was just declared, it might still be loading. If refreshing
                    doesn't help after a minute or two, use the WhatsApp contact on the homepage to report it. The team checks these
                    reports and corrects issues quickly. Result accuracy is something they take seriously.
                </div>

                <h3 class="ql-align-center">Can I see yesterday's Gali Satta and Disawar Satta result on Super 7 Satta?</h3>
                <div class="answer" id="faq-22">
                    Yes — the homepage shows yesterday's result and today's live result side by side for every game. For anything
                    older than that, the View Chart feature has records going back to 2023. Just click 'View Chart' on any game and
                    search by date — whatever you're looking for will be there.
                </div>

                <h3 class="ql-align-center">Is there a Super 7 Satta app for Android or iOS?</h3>
                <div class="answer" id="faq-23">
                    No dedicated app at the moment — it's not on Google Play or the App Store. But the website itself works well on
                    mobile browsers and loads fast on both Android and iPhone. Adding it to your home screen basically gives you the
                    same experience as using an app. And the WhatsApp and Telegram channels act as a push notification system for
                    result updates, so you're not missing much without a standalone app.
                </div>
            </div>
        </section> --}}
    </div>
@endsection

@push('scripts')
    <script>
        function openYearChart() {
            var gameSelect = document.getElementById('gameSelect');
            var yearSelect = document.getElementById('yearSelect');

            if (!gameSelect || !yearSelect) {
                return;
            }

            var slug = gameSelect.value;
            var year = yearSelect.value;

            if (!slug || !year) {
                return;
            }

            window.location.href = "{{ url('/records') }}/" + encodeURIComponent(slug) + "/" + encodeURIComponent(year);
        }
    </script>
@endpush