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
        <h3>{{ strtoupper($game->name ?? 'Game') }} {{ $year }} Full Chart 👇🏿</h3>
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

<div class="text-center my-6">
    <a href="{{ route('chart') }}"
       class="inline-block px-5 py-2 bg-yellow-400 text-black font-bold rounded-md hover:bg-yellow-300">
        Back To Chart
    </a>
</div>

@endsection