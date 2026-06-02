@extends('front.layouts.app', [
    'seo' => $seo ?? null,
])

@section('content')
    <section class="bg-white">
        <div class="text-center py-4">
            <h2 class="text-2xl font-bold uppercase">
                Super A7 Satta King Result Today – Updated Live Instantly
            </h2>
        </div>
    </section>


   <style>
    .rv-ad-wrap{
        width:100%;
        margin:12px auto;
        font-family:Arial,'Noto Sans Devanagari',sans-serif;
    }

    .rv-ad-box{
        background:linear-gradient(180deg,#ffd900 0%,#fff8cf 100%);
        border:3px dashed #e60000;
        border-radius:16px;
        padding:12px 10px;
        text-align:center;
        overflow:hidden;
        box-shadow:0 4px 12px rgba(0,0,0,.10);
    }

    .rv-ad-box,
    .rv-ad-box *{
        color:#111!important;
        font-size:16px!important;
        font-weight:700!important;
        line-height:1.45!important;
        word-break:break-word;
    }

    .rv-ad-box h1,
    .rv-ad-box h2,
    .rv-ad-box h3,
    .rv-ad-box h4,
    .rv-ad-box h5,
    .rv-ad-box h6,
    .rv-ad-box p,
    .rv-ad-box div{
        margin:4px 0!important;
        font-size:16px!important;
    }

    .rv-ad-title{
        font-size:18px!important;
        font-weight:800!important;
    }

    .rv-ad-name{
        font-size:19px!important;
        font-weight:900!important;
        color:#c9342d!important;
    }

    .rv-ad-img{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        background:#fff;
        border-radius:999px;
        padding:5px 12px;
        margin-top:8px;
        max-width:100%;
    }

    .rv-ad-img img{
        width:auto;
        height:auto;
        max-height:55px;
        max-width:200px;
        object-fit:contain;
    }

    .rv-middle{
        background:linear-gradient(180deg,#111827,#1f2937);
        border:3px dashed #ffd900;
    }

    .rv-middle,
    .rv-middle *{
        color:#fff!important;
    }

    .rv-middle .rv-ad-img img{
        max-height:55px;
        max-width:200px;
    }

    @media(max-width:640px){
        .rv-ad-wrap{
            margin:10px auto;
        }

        .rv-ad-box{
            border-width:3px;
            border-radius:14px;
            padding:10px 8px;
        }

        .rv-ad-box,
        .rv-ad-box *{
            font-size:14px!important;
            line-height:1.4!important;
            font-weight:700!important;
        }

        .rv-ad-box h1,
        .rv-ad-box h2,
        .rv-ad-box h3,
        .rv-ad-box h4,
        .rv-ad-box h5,
        .rv-ad-box h6,
        .rv-ad-box p,
        .rv-ad-box div{
            font-size:14px!important;
        }

        .rv-ad-title{
            font-size:15px!important;
        }

        .rv-ad-name{
            font-size:16px!important;
        }

        .rv-ad-img{
            padding:4px 10px;
            margin-top:6px;
        }

        .rv-ad-img img{
            max-height:48px;
            max-width:175px;
        }
    }
</style>


{{-- top --}}
@php
    $topAdvertisement = $advertisements->where('position', 'top')->first();
@endphp

@if ($topAdvertisement)
    <section class="rv-ad-wrap">
        <div class="rv-ad-box">
            @if (!empty($topAdvertisement->content))
                <div class="addb-content">
                    {!! $topAdvertisement->content !!}
                </div>
            @endif

            @if (!empty($topAdvertisement->image))
                @if (!empty($topAdvertisement->link))
                    <a href="{{ $topAdvertisement->link }}" target="_blank" style="text-decoration:none;">
                        <span class="rv-ad-img">
                            <img src="{{ asset('storage/' . $topAdvertisement->image) }}"
                                 alt="{{ $topAdvertisement->title }}">
                        </span>
                    </a>
                @else
                    <span class="rv-ad-img">
                        <img src="{{ asset('storage/' . $topAdvertisement->image) }}"
                             alt="{{ $topAdvertisement->title }}">
                    </span>
                @endif
            @endif
        </div>
    </section>
@else
    <section class="rv-ad-wrap">
        <div class="rv-ad-box">
            <h2 class="rv-ad-title">नमस्कार साथियों</h2>

            <p>
                सीधा कंपनी खाईवाल के पास गेम प्ले करे<br>
                बिंदास 1001% पेमेंट की गारंटी के साथ<br>
                आपका अपना भाई
            </p>

            <h2 class="rv-ad-name">S.K Bhai</h2>

            <span class="rv-ad-img">
                <img src="{{ asset('Wp.png') }}" alt="S.K Bhai">
            </span>
        </div>
    </section>
@endif
{{-- end top --}}


{{-- middle --}}
@php
    $middleAdvertisement = $advertisements->where('position', 'middle')->first();
@endphp

@if ($middleAdvertisement)
    <section class="rv-ad-wrap">
        <div class="rv-ad-box rv-middle">
            @if (!empty($middleAdvertisement->content))
                <div class="addb-content">
                    {!! $middleAdvertisement->content !!}
                </div>
            @endif

            @if ($middleAdvertisement->image)
                @if ($middleAdvertisement->link)
                    <a href="{{ $middleAdvertisement->link }}" target="_blank" style="text-decoration:none;">
                        <span class="rv-ad-img">
                            <img src="{{ asset('storage/' . $middleAdvertisement->image) }}"
                                 alt="{{ $middleAdvertisement->title }}">
                        </span>
                    </a>
                @else
                    <span class="rv-ad-img">
                        <img src="{{ asset('storage/' . $middleAdvertisement->image) }}"
                             alt="{{ $middleAdvertisement->title }}">
                    </span>
                @endif
            @endif
        </div>
    </section>
@else
    <section class="rv-ad-wrap">
        <div class="rv-ad-box rv-middle">
            <h4>
                व्हाट्सएप पर सुपर फास्ट रिजल्ट देखने के लिए नीचे दिए गए लिंक पर जाएं और चैनल को फॉलो करें।
            </h4>

            <a href="https://whatsapp.com/channel/0029Vb67katLikgE57Pwhj0T" style="text-decoration:none;">
                <span class="rv-ad-img">
                    <img src="{{ asset('Join-WhatsApp.png') }}" alt="Join WhatsApp">
                </span>
            </a>
        </div>
    </section>
@endif
{{-- end middle --}}


{{-- bottom --}}
@php
    $bottomAdvertisement = $advertisements->where('position', 'bottom')->first();
@endphp

@if ($bottomAdvertisement)
    <section class="rv-ad-wrap">
        <div class="rv-ad-box">
            @if (!empty($bottomAdvertisement->content))
                <div class="addb-content">
                    {!! $bottomAdvertisement->content !!}
                </div>
            @endif

            @if (!empty($bottomAdvertisement->image))
                @if (!empty($bottomAdvertisement->link))
                    <a href="{{ $bottomAdvertisement->link }}" target="_blank" style="text-decoration:none;">
                        <span class="rv-ad-img">
                            <img src="{{ asset('storage/' . $bottomAdvertisement->image) }}"
                                 alt="{{ $bottomAdvertisement->title }}">
                        </span>
                    </a>
                @else
                    <span class="rv-ad-img">
                        <img src="{{ asset('storage/' . $bottomAdvertisement->image) }}"
                             alt="{{ $bottomAdvertisement->title }}">
                    </span>
                @endif
            @endif
        </div>
    </section>
@else
    <section class="rv-ad-wrap">
        <div class="rv-ad-box">
            <div class="rv-ad-title">सीधे सट्टा कंपनी का No 1 खाईवाल</div>

            <div class="rv-ad-name">☆☆ ABHISHEK Bhai KHAIWAL ☆☆</div>

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

            <div class="rv-ad-name">☆☆ ABHISHEK Bhai KHAIWAL ☆☆</div>

            <div style="color:#9b59b6!important;font-weight:800!important;">
                Game Play करने के लिए नीचे लिंक पर क्लिक करे
            </div>

            <span class="rv-ad-img">
                <img src="{{ asset('whatsAppChat.png') }}" alt="ABHISHEK Bhai">
            </span>

            <div>Click to chat</div>
        </div>
    </section>
@endif
{{-- end bottom --}}



    {{-- Game List Section - 2 Parts --}}
<section class="row">
    @php
        // $gameSections = $games->chunk(ceil($games->count() / 2));
         $gameSections = $games->chunk(17);
    @endphp

    @foreach ($gameSections as $sectionIndex => $gameSection)
        <div class="{{ $sectionIndex > 0 ? 'mt-8' : '' }}">

            <div class="flex items-center justify-around space-x-4 bg-yellow-400">
                <p class="w-full p-3 font-bold text-white bg-purple-800">
                    GAME LIST PART {{ $sectionIndex + 1 }}
                </p>

                <div class="flex items-center justify-around bg-yellow-400 w-[75%]">
                    <p class="text-lg font-semibold">कल</p>
                    <p class="text-lg font-semibold">आज</p>
                </div>
            </div>

            <div class="w-full px-0 text-center">
                <div class="grid grid-cols-1 bg-white lg:grid-cols-3 md:grid-cols-2">

                    @forelse($gameSection as $game)
                        <div class="flex items-center justify-around space-x-4 border border-gray-900">
                            <div class="w-full p-3">
                                <p class="pb-2 text-xl font-bold tracking-wide text-gray-900 uppercase text-start hover:underline">
                                    <a href="{{ route('game.record', $game->slug) }}">
                                        {{ $game->name }}
                                    </a>
                                </p>

                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-sm font-semibold text-red-900">
                                        @if (!empty($game->result_time))
                                            {{ \Carbon\Carbon::parse($game->result_time)->format('h:i A') }}
                                        @endif
                                    </p>

                                    <a class="text-sm font-semibold text-blue-700 hover:underline"
                                       href="{{ route('game.yearRecord', [$game->slug, now('Asia/Kolkata')->year]) }}">
                                        View Chart
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-center justify-around w-[75%]">
                                <p class="text-2xl font-medium tracking-wider">
                                    @if (!empty($game->yesterdayResult->result))
                                        {{ is_numeric($game->yesterdayResult->result) && $game->yesterdayResult->result <= 9
                                            ? str_pad($game->yesterdayResult->result, 2, '0', STR_PAD_LEFT)
                                            : $game->yesterdayResult->result }}
                                    @else
                                        XX
                                    @endif
                                </p>

                                <p class="text-2xl font-medium tracking-wider">
                                    @if (!empty($game->todayResult->result) && in_array($game->todayResult->status ?? '', ['declared', 'published']))
                                        {{ is_numeric($game->todayResult->result) && $game->todayResult->result <= 9
                                            ? str_pad($game->todayResult->result, 2, '0', STR_PAD_LEFT)
                                            : $game->todayResult->result }}
                                    @else
                                        <strong class="waitimg">
                                            <img class="lazy"
                                                 alt="waiting"
                                                 src="{{ asset('tamplate/admin/upimages/d.gif') }}">
                                        </strong>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center">No result found</div>
                    @endforelse

                </div>
            </div>

        </div>
    @endforeach
</section>



    <div class="py-8 mx-auto mt-4 bg-gray-600">
        <h2 class="pb-4 text-2xl font-bold text-center text-white">
            Check All Game Year Chart
        </h2>

        <form method="get" action="#">
            <div class="flex items-center justify-center mx-auto rounded">
                <div class="flex mx-2">
                    <select id="gameSelect"
                        class="py-2 text-sm uppercase bg-white rounded-md outline-none md:py-3 md:text-base lg:px-3">
                        @foreach ($chartGames as $game)
                            <option value="{{ $game->slug }}">
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>

                    <select id="yearSelect"
                        class="px-2 py-2 mx-0 ml-1 text-sm bg-white rounded-md outline-none md:py-3 md:text-base lg:mx-3">
                        <option value="{{ now('Asia/Kolkata')->year }}">{{ now('Asia/Kolkata')->year }}</option>
                        <option value="{{ now('Asia/Kolkata')->subYear()->year }}">
                            {{ now('Asia/Kolkata')->subYear()->year }}</option>
                        <option value="{{ now('Asia/Kolkata')->subYears(2)->year }}">
                            {{ now('Asia/Kolkata')->subYears(2)->year }}</option>
                    </select>
                </div>

                <button type="button" onclick="openYearChart()" class="ShinyButton_shadow__btn__ZfTiW">
                    Check Chart
                </button>
            </div>
        </form>
    </div>

  
    {{-- Monthly Chart Result Section --}}
    @php
        $chartGameSections = $chartGames->chunk(15);
    @endphp

    <section class="w-full mt-6 px-2">

        @foreach ($chartGameSections as $sectionIndex => $gameSection)
            <div class="mb-8 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

                <div class="bg-[#0aa485] text-white text-center font-bold py-3 text-base lg:text-xl">
                    Chart Result

                </div>

                <div class="w-full overflow-x-auto">
                    <table class="min-w-max w-full border-separate border-spacing-[3px] text-center">

                        <thead>
                            <tr>
                                <th
                                    class="sticky left-0 z-20 min-w-[115px] bg-[#0aa485] text-white px-3 py-3 rounded-lg text-sm font-bold">
                                    Date
                                </th>

                                @foreach ($gameSection as $game)
                                    <th
                                        class="min-w-[100px] bg-[#0aa485] text-white px-3 py-3 rounded-lg text-xs lg:text-sm font-bold leading-tight whitespace-normal">
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
                                    <td
                                        class="sticky left-0 z-10 min-w-[115px] bg-[#2d4b58] text-white px-3 py-4 rounded-lg text-sm font-semibold">
                                        {{ $date->format('d-m-Y') }}
                                    </td>

                                    @foreach ($gameSection as $game)
                                        @php
                                            $result = $dayResults->get($game->slug);
                                        @endphp

                                        <td
                                            class="min-w-[100px] bg-[#2d4b58] text-white px-3 py-4 rounded-lg text-sm font-bold">
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



    <section class="bg-white md:py-4 homeContent">
        {{-- <h2 style="padding:1rem 1.5rem;background:#406e83;text-align:center;font-size:1.2rem;color:#fff;">
            Super A7 Satta – India's Most Trusted A7 Satta King Result Platform
        </h2> --}}

        {{-- <div style="padding:10px;">
            Welcome to Super 7 Satta — your daily source for A7 Satta results, charts, and live number updates.
        </div> --}}
    </section>

    <script>
        function openYearChart() {
            let slug = document.getElementById('gameSelect').value;
            let year = document.getElementById('yearSelect').value;

            window.location.href = "{{ url('/record') }}/" + slug + "/" + year;
        }
    </script>



    <section class="bg-white md:py-4 homeContent container">


        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;"> Super A7
            Satta – India's Most Trusted A7 Satta King Result Platform </h2>
        <div style="padding: 10px;">
            Welcome to Super 7 Satta — your daily source for A7 Satta results, charts, and live number updates. If you are
            looking for today's result or want to browse past records, everything is available here in one place. This is
            one of the most followed games in the satta world. Players visit daily because the result is declared every day,
            the chart history is easy to access, and the format is simple to understand — whether you are new or have been
            following satta games for years. Along with A7 Satta, you can also check the <a
                href="https://super-7-satta.com/records/disawar" style="color:blue;">Desawar Result Today</a> updated on
            this platform daily.
            <br>
            On this website you will get:<br>
            • Daily A7 Satta result — updated the moment it is declared<br>
            • Full chart history — easy to read and navigate<br>
            • Past records going back to 2023<br>
            • Live updates for all major satta markets

        </div>
        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;">A7 Satta
            Result Today</h2>
        <div style="padding: 10px;">
            Thousands of players check the <a href="/" style="color:blue;">A7 Satta</a> result every single day.
            Getting the number on time helps players stay updated and compare with previous outcomes. This page is updated
            daily in a clean, organized format. No need to visit multiple websites — the latest result is right here as soon
            as it is officially announced. Players who also follow <a href="https://super-7-satta.com/records/delhi-bazar"
                style="color:blue;">Delhi Bazar Result Chart</a> will find that update here as well, listed alongside A7 in
            the same table.

        </div>
        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;">
            Why This Platform is Popular
        </h2>
        <div style="padding: 10px;">
            Many satta result websites exist online, but Super 7 Satta stands out for a few clear reasons:<br>
            • Daily Results — A fresh number is declared every day, keeping the game consistently active<br>
            • Clear Chart History — Past results are presented in a clean, date-wise format<br>
            • Wide Coverage — 25+ markets updated daily, all in one table<br>
            • No Login Needed — Results and charts are fully accessible without signing up<br>
            • Simple Format — Easy for both new visitors and long-time followers<br>
            For players who also track the <a href="https://super-7-satta.com/records/shri-ganesh"
                style="color:blue;">Shri
                Ganesh Result Chart</a>, all records are available here without needing to switch
            between different websites.

        </div>
        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;">
            A7 Satta Chart & Past Records
        </h2>
        <div style="padding: 10px;">
            The chart is one of the most useful features on this platform. It is a complete date-by-date record of every
            result declared for each market, going back to 2023. Daily results are listed in chronological order, with
            monthly and yearly records available for every market in a clean table format. Many players refer to the chart
            to verify old numbers or study historical data. Those who regularly follow the <a
                href="https://super-7-satta.com/records/faridabad" style="color:blue;">Faridabad Result Chart</a> can find
            its full chart history here as well. To access any chart, simply click View Chart next to the game on the
            homepage — no extra steps required.</div>
        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;">
            A7 Satta King – What the Term Means
        </h2>
        <div style="padding: 10px;">
            The term A7 Satta King is widely used across the satta community in India. In the traditional Satta Matka
            format, the declared number for a market determines the winner for that day. The player who correctly predicts
            that number is informally referred to as the Satta King for that round. Super 7 Satta publishes these results as
            soon as they are officially declared. The platform does not conduct games or accept bets — its only role is to
            deliver accurate, timely result updates. Players tracking the <a
                href="https://super-7-satta.com/records/gaziabad" style="color:blue;">Ghaziabad Result Today Chart</a>
            will find the same reliable, on-time updates here.
        </div>
        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;">
            Live Updates – Always On Time
        </h2>
        <div style="padding: 10px;">
            No one wants to wait for a result. On Super 7 Satta, numbers go live within seconds of the official announcement
            — whether you are checking on your phone or desktop. The layout is kept simple on purpose — today's live result
            for every market, full chart history accessible with one click, and links to all related satta games in one
            place. This makes it easy to stay updated without confusion or delay, no matter how many markets you follow. If
            <a href="https://super-7-satta.com/records/gali" style="color:blue;">Gali Result Chart</a> is part of your
            daily check, you will find it updated here the moment it is officially declared.
        </div>
        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;">
            Responsible Information
        </h2>
        <div style="padding: 10px;">
            All result data and charts published on this website are for informational and entertainment purposes only. This
            platform does not promote, conduct, or facilitate gambling or betting of any kind. Satta-related activities may
            be restricted or illegal in certain states in India. Visitors are advised to check local laws before accessing
            this content. We are not responsible for any financial loss or legal consequences.

        </div>
        <h2 class="ql-align-center"
            style="padding: 1rem 1.5rem;background: #406e83;text-align: center; font-size: 1.2rem;color: #fff;">
            Conclusion
        </h2>
        <div style="padding: 10px;">
            Super 7 Satta is a reliable daily destination for A7 Satta result updates, chart history, and live number
            announcements. Whether you want today's result or need to look up a past number — it is all here, updated every
            day without delay. Bookmark this page and come back daily so you never miss an update.

        </div>
        <h4 class="ql-align-center">FAQs — Super A7 Satta</h4>
        <h4 class="ql-align-center">Q1.What is Super 7 Satta and how does it connect to A7 Satta King?</h4>
        <div class="answer" id="a1" style="padding:10px;">
            If you've been searching for Satta King results and landed on super-7-satta.com, you already know what this
            place is about. Super 7 Satta has been running as one of the more reliable spots to get A7 Satta King updates —
            things like live results, old charts, and daily game numbers for markets like Disawar, Gali, Faridabad,
            Ghaziabad, Delhi Bazaar, Palika Bazar, and others. Players in the community started calling it A7 Satta or Super
            7 Satta interchangeably, and the name just stuck. It's not complicated — you open the site, results are right
            there.
        </div>



        <h4 class="ql-align-center">What exactly is A7 Satta King? Where does the name 'A7' come from?</h4>
        <div class="answer" id="a2" style="padding:10px;">
            Honestly, there's no deep meaning behind it. 'A7' is just a term that caught on within the Satta player
            community — people started associating it with fast, no-nonsense result sites, and Super-7-Satta.com became one
            of the names people trust when they want Disawar, Gali, or Faridabad results without waiting around. It's grown
            quite a bit over the past couple of years, mostly through word of mouth.
        </div>



        <h4 class="ql-align-center">How many games does Super 7 Satta cover every day?</h4>
        <div class="answer" id="a3" style="padding:10px;">
            More than 25 games, updated every single day. We're talking Disawar, Gali, Ghaziabad, Faridabad, Delhi Bazaar,
            Palika Bazar — the ones everyone already knows — but also Prayagraj, Shri Ganesh, Roop Nagar, Gwalior, Fatehpur,
            Alwar, Noida Night, Dwarka, Goa Night, Jeevan Shree, Delhi Matka, MeghaCity, Dehradun City, Aligarh Night,
            Chatisgarh, Sadar Bazar, and a few more. Finding all these results on a single site is actually rare — most
            platforms miss half these markets.
        </div>



        <h4 class="ql-align-center">How do I check today's A7 Satta King result on Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Just open super-7-satta.com. No login, no registration, no pop-ups asking you to sign up. The homepage has a
            live result table showing yesterday's number and today's result for every game, side by side. As soon as a
            result is officially declared, it goes up. That's it — nothing fancy about the process.
        </div>

        <h4 class="ql-align-center">What time does the Disawar result usually come on Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Disawar result comes out at around 2:00 AM in the night. Super 7 Satta posts it within seconds after the
            official announcement — if you've been using the site for a while, you've probably noticed it's usually up
            before most other sites even update. Disawar is one of those old-school markets that people have been following
            for decades, so there's a lot of interest in it.
        </div>

        <h4 class="ql-align-center">Why does the result show 'waiting' for some games on Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            That just means the result hasn't come out yet from the official source. The site only updates when the real
            number is declared — it won't guess or post anything unofficial. Sometimes games get delayed for reasons on the
            operator's side. If you see 'waiting' for longer than usual, try refreshing. Or better yet, join the WhatsApp or
            Telegram channel — you'll get an alert the moment the result drops.
        </div>

        <h4 class="ql-align-center">Can I get Super 7 Satta results on WhatsApp or Telegram?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Yes, and many regular users actually prefer this over opening the website every time. Both the WhatsApp channel
            and Telegram channel push result updates directly to your phone as soon as they're posted. You'll find the links
            on the homepage. If you follow multiple markets, this saves a lot of time — results just come to you.
        </div>

        <h4 class="ql-align-center">What is a Satta King chart and how do I read the one on Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            A chart is just a date-by-date record of past results for a game. Each row shows one date and the number that
            was declared on that day. People use charts to study old results, spot patterns, or simply verify a past number.
            On Super 7 Satta, charts are available from 2023 to 2026. Hit the 'View Chart' button on the homepage next to
            any game and it opens right up — no extra steps.
        </div>

        <h4 class="ql-align-center">How do I check the yearly chart for Disawar or Gali on Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Two ways to do it. First option — scroll to the game in the list and click 'View Chart' directly. Second option
            — go to the 'Check All Game Year Chart' section near the bottom of the homepage, choose the game name, pick a
            year (2023, 2024, 2025, or 2026), and click 'Check Chart'. The full year's record loads up. Useful if you're
            looking at a specific game's history in one go.
        </div>

        <h4 class="ql-align-center">Is the monthly chart updated every day?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Yes. After each game result comes in, the current month's chart is updated to include it. So whatever you see is
            current. Older charts from past months and years are stored permanently on the site — you can go back and look
            up results from 2023 just as easily as checking last week's numbers.
        </div>
        <h4 class="ql-align-center">Does Super 7 Satta have charts for Faridabad, Ghaziabad, and Shri Ganesh Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Yes — charts for all of them are available. Faridabad, Ghaziabad, Shri Ganesh, Gali, Disawar, Delhi Bazaar,
            Sadar Bazar — all covered with full monthly and yearly records. Click 'View Chart' next to the game you want
            from the homepage and it'll pull up the complete history.
        </div>
        <h4 class="ql-align-center">What is Satta King and how does the number game work?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Satta King is a number-guessing game where you pick a two-digit number between 00 and 99. If the declared result
            matches your number, you win. Different markets — like Gali, Disawar, Faridabad — announce results at different
            times of the day and night. Super 7 Satta's role is only to publish those results once they're officially
            declared. The platform doesn't run games, doesn't take bets, doesn't involve itself in any of that.
        </div>
        <h4 class="ql-align-center">Who is a Khaiwal in Satta King, and how do I find one through Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            A Khaiwal is essentially a middleman — they collect your bet, pass it to the game operator, and then handle your
            payout if you win. Super 7 Satta lists verified Khaiwal contacts on the homepage through WhatsApp. These are
            people who work directly with the official game companies. If you want to place a bet, you reach out to them.
            Super 7 Satta itself only shares result information — it has nothing to do with taking or managing bets.
        </div>
        <h4 class="ql-align-center">Is Satta King legal in India? What about Super 7 Satta's legal status?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Gambling laws in India differ from state to state. The main law is the Public Gambling Act of 1867, and most
            states use it to restrict or ban Satta and number-based gambling. Whether something is legal for you depends on
            your state. Super 7 Satta only publishes results — it's an informational website, not a gambling platform. Think
            of it like a news site that reports scores. It doesn't conduct or promote any gambling. That said, anyone using
            Satta platforms should look into what the rules say in their state.
        </div>
        <h4 class="ql-align-center">Is it safe to use super-7-satta.com? Will my data be shared?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            The site is read-only — you're just looking at results and charts. No personal information is collected from
            regular visitors. There's no sign-up wall for accessing results, so nothing is being stored about you in the
            background. The site runs on ad sponsorship. If you want to read the full disclaimer, it's on the website.
        </div>
        <h4 class="ql-align-center">Are the results on Super 7 Satta accurate?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Results are sourced directly from official game operators and verified through Khaiwal networks. Super 7 Satta
            has maintained a consistent record of accurate, timely updates across all the markets it covers. That said, when
            there's a delay or error, it usually comes from the source operator's end — the platform can't control what
            happens before the number is submitted. Errors that get flagged are corrected quickly.
        </div>


        <h4 class="ql-align-center">What makes Super 7 Satta better than other A7 Satta King websites?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            A few things make a real difference. Coverage is wider — 25+ games daily is more than most competitors bother
            with. Speed matters too — results go up in real time, and regular users have noted it beats other sites to the
            post fairly often. The chart history is also more complete — year-wise records from 2023 to 2026 are available
            for every game. On top of that, content is available in both Hindi and English, which opens it up to more users.
        </div>
        <h4 class="ql-align-center">Does Super 7 Satta cover all the games other A7 Satta King sites cover?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Yes, and beyond. Every game you'd find on a typical A7 Satta platform is here — Disawar, Gali, Faridabad,
            Ghaziabad, Delhi Bazaar, Shri Ganesh, Sadar Bazar. But Super 7 Satta also covers Palika Bazar, Prayagraj, Roop
            Nagar, Gwalior, Fatehpur, Alwar, Agra, Dwarka, Noida Night, Goa Night, Jeevan Shree, MeghaCity, Dehradun City,
            Aligarh Night, Delhi Matka, and Chatisgarh. That's hard to match on a single platform.
        </div>
        <h4 class="ql-align-center">How do I bookmark Super 7 Satta on my mobile?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            On Android with Chrome — open the site, tap the three-dot menu at the top right, and select 'Add to Home
            Screen'. On iPhone with Safari — tap the Share icon at the bottom and pick 'Add to Home Screen'. A shortcut icon
            appears on your phone's home screen and opens the site directly, like an app. No typing the URL every time.
        </div>
        <h4 class="ql-align-center">Does Super 7 Satta have a login? What is it used for?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            There's a login on the site, but it's only for Khaiwal partners and verified game operators who submit results.
            If you're a regular visitor checking results or browsing charts, you don't need an account. Everything —
            results, charts, game lists — is visible without logging in.
        </div>
        <h4 class="ql-align-center">What should I do if a result is missing or incorrect on Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            First thing — refresh the page. If the result was just declared, it might still be loading. If refreshing
            doesn't help after a minute or two, use the WhatsApp contact on the homepage to report it. The team checks these
            reports and corrects issues quickly. Result accuracy is something they take seriously.
        </div>

        <h4 class="ql-align-center">Can I see yesterday's Gali Satta and Disawar Satta result on Super 7 Satta?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            Yes — the homepage shows yesterday's result and today's live result side by side for every game. For anything
            older than that, the View Chart feature has records going back to 2023. Just click 'View Chart' on any game and
            search by date — whatever you're looking for will be there.
        </div>
        <h4 class="ql-align-center">Is there a Super 7 Satta app for Android or iOS?</h4>
        <div class="answer" id="a4" style="padding:10px;">
            No dedicated app at the moment — it's not on Google Play or the App Store. But the website itself works well on
            mobile browsers and loads fast on both Android and iPhone. Adding it to your home screen (as mentioned above)
            basically gives you the same experience as using an app. And the WhatsApp and Telegram channels act as a push
            notification system for result updates, so you're not missing much without a standalone app.
        </div>


        <!--<h4 class="ql-align-center" >Q5. Is it safe to play Super A7 Satta online?</h4>-->
        <!--<div class="answer" id="a5">-->
        <!--  A5. We provide information only. The satta is all about luck, so play it responsibly.-->
        <!--</div>-->
    </section>


    <style>
        p br {
            display: block;
        }
    </style>
@endsection
