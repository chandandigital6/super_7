@extends('front.layouts.app',[
    'seo' => $seo ?? null
])

@section('content')

<section class="bg-white">
    <div class="text-center py-4">
        <h1 class="text-2xl font-bold uppercase text-black">
            {{ $game->name ?? 'Game' }} Result Chart {{ $year }}
        </h1>

        <p class="py-2 text-sm text-gray-800">
            @if(!empty($game->result_time))
                Result Time: {{ $game->result_time }}
            @else
                Result Time: -
            @endif
        </p>
    </div>
</section>

<section class="grid grid-cols-1 gap-2 bg-white lg:grid-cols-1">
    <div class="text-center text-black px-4 py-2 shadow-xl bg-yellow-50 border pt-4 mx-2 my-2 rounded-xl leading-6 font-semibold h-fit text-lg">
        <h2>{{ strtoupper($game->name ?? 'Game') }} {{ $year }} Full Chart 👇🏿</h2>
    </div>
</section>

@php
    $months = [
        1  => 'JAN', 2  => 'FEB', 3  => 'MAR',
        4  => 'APR', 5  => 'MAY', 6  => 'JUN',
        7  => 'JUL', 8  => 'AUG', 9  => 'SEP',
        10 => 'OCT', 11 => 'NOV', 12 => 'DEC',
    ];

    // Build lookup: "month-day" => item
    $yearResults = collect($results)
        ->filter(fn($item) => !empty($item->result_date))
        ->keyBy(function ($item) {
            $date = \Carbon\Carbon::parse($item->result_date);
            return $date->format('n') . '-' . $date->format('j');
        });
@endphp

<div class="w-full overflow-x-auto bg-white shadow-md mt-4">
    <table class="w-full text-sm text-center border-collapse whitespace-nowrap">

        {{-- Header --}}
        <thead>
            <tr>
                <td class="py-3 px-3 bg-[#0aa485] text-[12px] lg:text-base font-bold text-white border border-[#088a6f]">
                    {{ $year }}
                </td>
                @foreach($months as $monthName)
                    <td class="py-3 px-3 bg-[#0aa485] text-[12px] lg:text-base font-bold text-white border border-[#088a6f]">
                        {{ $monthName }}
                    </td>
                @endforeach
            </tr>
        </thead>

        {{-- Day rows --}}
        <tbody>
            @for($day = 1; $day <= 31; $day++)
                <tr>
                    {{-- Date cell --}}
                    <td class="px-2 py-3 bg-[#2d4b58] text-white text-sm font-semibold border border-[#243d49]">
                        {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                    </td>

                    @foreach($months as $monthNumber => $monthName)
                        @php
                            $daysInMonth = \Carbon\Carbon::create($year, $monthNumber, 1)->daysInMonth;

                            if ($day > $daysInMonth) {
                                $display   = '';
                                $isInvalid = true;
                            } else {
                                $isInvalid = false;
                                $key  = $monthNumber . '-' . $day;
                                $item = $yearResults->get($key);

                                $display = ($item && ($item->status ?? '') === 'declared' && !empty($item->result))
                                    ? str_pad($item->result, 2, '0', STR_PAD_LEFT)
                                    : '-';
                            }
                        @endphp

                        @if($isInvalid)
                            <td class="px-2 py-3 bg-gray-100 text-gray-300 text-sm font-semibold border border-gray-200">
                                &nbsp;
                            </td>
                        @else
                            <td class="px-2 py-3 bg-white text-sm font-bold border border-gray-200 {{ $display !== '-' ? 'text-[#0aa485]' : 'text-gray-400' }}">
                                {{ $display }}
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endfor
        </tbody>

    </table>
</div>

@if(isset($contentBlocks) && $contentBlocks->count())
    <div class="mt-8 space-y-6">
        @foreach($contentBlocks as $block)
            <div class="rounded-xl border bg-white p-5 shadow-sm">
                @if($block->title)
                    <h2 class="mb-3 text-xl font-bold">
                        {{ $block->title }}
                    </h2>
                @endif
                <div class="content-block-content">
                    {!! $block->content !!}
                </div>
            </div>
        @endforeach
    </div>
@endif

<div class="text-center my-6">
    <a href="{{ route('chart') }}"
       class="inline-block px-5 py-2 bg-yellow-400 text-black font-bold rounded-md hover:bg-yellow-300">
        Back To Chart
    </a>
</div>

@endsection




















{{-- @extends('front.layouts.app',[
    'seo' => $seo ?? null
])

@section('content')

<section class="bg-white">
    <div class="text-center py-4">
        <h1 class="text-2xl font-bold uppercase text-black">
            {{ $game->name ?? 'Game' }} Result Chart {{ $year }}
        </h1>

        <p class="py-2 text-sm text-gray-800">
            @if(!empty($game->result_time))
                Result Time: {{ $game->result_time }}
            @else
                Result Time: -
            @endif
        </p>
    </div>
</section>

<section class="grid grid-cols-1 gap-2 bg-white lg:grid-cols-1">
    <div class="text-center text-black px-4 py-2 shadow-xl bg-yellow-50 border pt-4 mx-2 my-2 rounded-xl leading-6 font-semibold h-fit text-lg">
        <h2>{{ strtoupper($game->name ?? 'Game') }} {{ $year }} Full Chart 👇🏿</h2>
    </div>
</section>

<div class="w-full overflow-x-auto bg-white shadow-md mt-4">
    <table class="w-full overflow-x-auto text-sm text-left text-gray-500 border-separate table-auto whitespace-nowrap lg:table-fixed">
        <thead>
            <tr>
                <td class="py-3 bg-[#0aa485] text-center text-[12px] lg:text-base font-bold text-white rounded-lg">
                    Date
                </td>

                <td class="py-3 bg-[#0aa485] text-center text-[12px] lg:text-base font-bold text-white rounded-lg">
                    Result
                </td>

                <td class="py-3 bg-[#0aa485] text-center text-[12px] lg:text-base font-bold text-white rounded-lg">
                    Status
                </td>
            </tr>
        </thead>

        <tbody>
            @forelse($results as $result)
                <tr>
                    <td class="text-white lg:px-6 px-1 lg:py-4 py-3 bg-[#2d4b58] text-sm font-semibold rounded-lg text-center">
                        @if(!empty($result->result_date))
                            {{ \Carbon\Carbon::parse($result->result_date)->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </td>

                    <td class="text-white lg:px-6 px-1 lg:py-4 py-3 bg-[#2d4b58] text-sm font-semibold rounded-lg text-center">
                        @if(!empty($result->result))
                            {{ str_pad($result->result, 2, '0', STR_PAD_LEFT) }}
                        @else
                            -
                        @endif
                    </td>

                    <td class="text-white lg:px-6 px-1 lg:py-4 py-3 bg-[#2d4b58] text-sm font-semibold rounded-lg text-center uppercase">
                        {{ $result->status ?? 'waiting' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-black bg-white">
                        No record found for {{ $year }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(isset($contentBlocks) && $contentBlocks->count())
    <div class="mt-8 space-y-6">
        @foreach($contentBlocks as $block)
            <div class="rounded-xl border bg-white p-5 shadow-sm">
                @if($block->title)
                    <h2 class="mb-3 text-xl font-bold">
                        {{ $block->title }}
                    </h2>
                @endif

              <div class="content-block-content">
    {!! $block->content !!}
</div>
            </div>
        @endforeach
    </div>
@endif


<div class="text-center my-6">
    <a href="{{ route('chart') }}"
       class="inline-block px-5 py-2 bg-yellow-400 text-black font-bold rounded-md hover:bg-yellow-300">
        Back To Chart
    </a>
</div>

@endsection --}}