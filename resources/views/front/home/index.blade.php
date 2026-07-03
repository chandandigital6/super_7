@extends('front.layouts.app', [
    'seo' => $seo ?? null,
])

@section('content')
    @php
        $topAdvertisement = $advertisements->where('position', 'top')->first();
        $middleAdvertisement = $advertisements->where('position', 'middle')->first();
        $bottomAdvertisement = $advertisements->where('position', 'bottom')->first();

        $currentYear = now('Asia/Kolkata')->year;
        $years = [$currentYear, $currentYear - 1, $currentYear - 2];

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

        .rv-ad-box>div:not(.addb-content) {
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, .15);
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
                            <a href="{{ $topAdvertisement->link }}" target="_blank" rel="noopener nofollow"
                                style="text-decoration:none;">
                                <span class="rv-ad-img">
                                    <img src="{{ asset('storage/' . $topAdvertisement->image) }}"
                                        alt="{{ $topAdvertisement->title ?? 'Advertisement' }}" width="139"
                                        height="48" loading="eager" decoding="async" fetchpriority="high">
                                </span>
                            </a>
                        @else
                            <span class="rv-ad-img">
                                <img src="{{ asset('storage/' . $topAdvertisement->image) }}"
                                    alt="{{ $topAdvertisement->title ?? 'Advertisement' }}" width="139" height="48"
                                    loading="eager" decoding="async" fetchpriority="high">
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
                        <img src="{{ asset('Wp.png') }}" alt="S.K Bhai" width="139" height="48" loading="eager"
                            decoding="async" fetchpriority="high">
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
                            <a href="{{ $middleAdvertisement->link }}" target="_blank" rel="noopener nofollow"
                                style="text-decoration:none;">
                                <span class="rv-ad-img">
                                    <img src="{{ asset('storage/' . $middleAdvertisement->image) }}"
                                        alt="{{ $middleAdvertisement->title ?? 'Advertisement' }}" width="159"
                                        height="55" loading="lazy" decoding="async">
                                </span>
                            </a>
                        @else
                            <span class="rv-ad-img">
                                <img src="{{ asset('storage/' . $middleAdvertisement->image) }}"
                                    alt="{{ $middleAdvertisement->title ?? 'Advertisement' }}" width="159"
                                    height="55" loading="lazy" decoding="async">
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

                    <a href="https://whatsapp.com/channel/0029Vb67katLikgE57Pwhj0T" target="_blank" rel="noopener nofollow"
                        style="text-decoration:none;">
                        <span class="rv-ad-img">
                            <img src="{{ asset('Join-WhatsApp.png') }}" alt="Join WhatsApp" width="159" height="55"
                                loading="lazy" decoding="async">
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
                            <a href="{{ $bottomAdvertisement->link }}" target="_blank" rel="noopener nofollow"
                                style="text-decoration:none;">
                                <span class="rv-ad-img">
                                    <img src="{{ asset('storage/' . $bottomAdvertisement->image) }}"
                                        alt="{{ $bottomAdvertisement->title ?? 'Advertisement' }}" width="139"
                                        height="48" loading="lazy" decoding="async">
                                </span>
                            </a>
                        @else
                            <span class="rv-ad-img">
                                <img src="{{ asset('storage/' . $bottomAdvertisement->image) }}"
                                    alt="{{ $bottomAdvertisement->title ?? 'Advertisement' }}" width="139"
                                    height="48" loading="lazy" decoding="async">
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
                        <img src="{{ asset('whatsAppChat.png') }}" alt="ABHISHEK BHAI" width="139" height="48"
                            loading="lazy" decoding="async">
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

                                            {{-- <a href="{{ route('game.yearRecord', [$game->slug, $currentYear]) }}"
                                               class="rv-chart-btn">
                                                View Chart
                                            </a> --}}

                                            <a href="{{ route('game.record', $game->slug) }}" class="rv-chart-btn">
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
                                                        src="{{ asset('tamplate/admin/upimages/d.gif') }}" width="40"
                                                        height="40" loading="lazy" decoding="async">
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
        {{-- Year Chart Selector --}}
        <section class="rv-year-box" aria-label="Check All Game 2026 Chart">
            <h2>Check All Game 2026 Chart</h2>

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
                            <option value="2026">2026</option>
                        </select>
                    </div>

                    <button type="button" onclick="openYearChart()" class="rv-year-button">
                        Check Chart
                    </button>
                </div>
            </form>
        </section>

        <script>
            function openYearChart() {
                let slug = document.getElementById('gameSelect').value;

                if (!slug) {
                    alert('Please select game');
                    return;
                }

                window.location.href = "{{ url('/records') }}/" + slug;
            }
        </script>

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
                    If you follow Satta games, chances are you’ve come across <a href="/">A7 Satta</a> quite a bit
                    lately. It has quickly become one of the most popular choices because it gives players fast access to
                    fresh results, detailed charts, and all the information they actually need. Whether you’re looking for
                    today’s <strong>A7 Satta King Result</strong> or just want to check past numbers, everything is right
                    here in one clean place.
                </div>

                <h2 class="ql-align-center">What is A7 Satta Really About?</h2>
                <div class="rv-text">
                    A7 Satta is a straightforward number game that keeps things exciting day after day. You pick a two-digit
                    number between 00 and 99, and when the official result comes out at its fixed time, you know right away
                    if you’ve won that round.
                    <br><br>
                    What makes it special is the consistency. On Super 7 Satta, results are posted the moment they’re
                    declared. Newcomers find it easy to understand, while regular players love that they can trust the
                    timing and accuracy. It’s not complicated — just good, reliable updates you can count on.
                </div>

                <h2 class="ql-align-center">Checking the A7 Satta Result</h2>
                <div class="rv-text">
                    The <strong>A7 Satta Result</strong> is the highlight of the day — the one number everyone waits for. We
                    update it instantly on this page as soon as it’s official, so you don’t have to keep switching tabs or
                    sites.
                    <br><br>
                    You’ll always see today’s result right next to yesterday’s, making it simple to compare and follow the
                    flow. A lot of people visit this page multiple times daily just for this section because it’s clear,
                    fast, and trustworthy.
                </div>

                <h2 class="ql-align-center">Understanding A7 Satta King</h2>
                <div class="rv-text">
                    In the Satta community, <strong>A7 Satta King</strong> is a respected title. It goes to the person (or
                    the prediction) that hits the exact winning number for the day. Getting it right feels great, and you’ll
                    often see players sharing their King moments with friends.
                    <br><br>
                    That’s why we put extra focus on these updates. Beyond just showing the number, we give you full charts
                    and history so you can learn, spot patterns, and enjoy the game more. Whether you’re new or experienced,
                    tracking A7 Satta King adds real value to your daily routine.
                    <br><br>
                    All in all, this page brings together live results, helpful charts, and easy navigation — everything you
                    need to enjoy A7 Satta without stress or confusion. Bookmark it and you’ll always be up to date.
                </div>

                <h2 class="ql-align-center">Other Popular Markets You Can Follow Here</h2>
                <div class="rv-text">
                    After getting comfortable with A7 Satta, most players like to explore the other strong markets we cover.
                    Each one has its own timing and personality, but they all work together nicely on the same platform.
                </div>

                <h3 class="ql-align-center">Delhi Bazar Satta</h3>
                <div class="rv-text">
                    Delhi Bazar is a lively daytime game with results usually out in the early afternoon. Many people check
                    the <a href="https://super-7-satta.com/records/delhi-bazar">Delhi Bazar Result Chart</a> after A7 Satta
                    because the timing fits well. We keep clean charts ready so you can track patterns easily.
                </div>

                <h3 class="ql-align-center">Shri Ganesh Satta</h3>
                <div class="rv-text">
                    Shri Ganesh has a loyal following and runs in the mid-afternoon. It feels like a natural next step after
                    A7 Satta. Our <a href="https://super-7-satta.com/records/shri-ganesh">Shri Ganesh Result Chart</a>
                    updates are quick, and the full charts help you stay on top of things.
                </div>

                <h3 class="ql-align-center">Faridabad Satta</h3>
                <div class="rv-text">
                    Faridabad is one of the most followed evening markets. Results generally come in the late afternoon or
                    early evening. A lot of A7 Satta players also track <a
                        href="https://super-7-satta.com/records/faridabad">Faridabad Result Chart</a> here because the
                    charts and updates are reliable.
                </div>

                <h3 class="ql-align-center">Ghaziabad Satta</h3>
                <div class="rv-text">
                    Ghaziabad brings evening energy with its consistent timing around 8–9 PM. It pairs really well with your
                    A7 Satta routine. Get fast <a href="https://super-7-satta.com/records/gaziabad">Ghaziabad Result Today
                        Chart</a> updates and complete charts without any hassle.
                </div>

                <h3 class="ql-align-center">Gali Satta</h3>
                <div class="rv-text">
                    Gali is a classic late-night favorite. Many people make it part of their nightly routine after checking
                    earlier markets. <a href="https://super-7-satta.com/records/gali">Gali Result Chart</a> is posted
                    quickly, along with detailed historical charts.
                </div>

                <h3 class="ql-align-center">Desawar Satta</h3>
                <div class="rv-text">
                    Desawar, often written as Deswar, closes the day (or starts the next) with its early morning result
                    around 2–3 AM. It’s one of the most respected markets and many A7 Satta followers check it daily. We
                    have instant <a href="https://super-7-satta.com/records/disawar">Desawar Result Today</a> and deep
                    charts available.
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
                    It’s a popular daily number game where players predict two-digit results. We provide fast live updates,
                    charts, and clear info so you can follow easily.
                </div>

                <h3 class="ql-align-center">How do I see today’s A7 Satta Result?</h3>
                <div class="answer">
                    Just stay on this page. We update the A7 Satta Result immediately when it’s declared, with yesterday’s
                    number shown side by side.
                </div>

                <h3 class="ql-align-center">What does A7 Satta King mean?</h3>
                <div class="answer">
                    It’s the title for the winning prediction or player who hits the exact number of the day. We track and
                    show A7 Satta King results clearly.
                </div>

                <h3 class="ql-align-center">How does A7 Satta compare to Delhi Bazar or others?</h3>
                <div class="answer">
                    A7 Satta is our main focus, but markets like Delhi Bazar follow similar rules with different timings.
                    You can follow everything here in one place.
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
                    Yes. We focus on accurate results, charts, and helpful information for A7 Satta King and related games
                    for entertainment and informational purposes only.
                </div>

            </div>
        </section>



        {{-- SEO Content --}}


    </div>
@endsection

{{-- @push('scripts')
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
@endpush --}}
