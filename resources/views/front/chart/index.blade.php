@extends('front.layouts.app', [
    'seo' => $seo ?? null,
])

@section('content')

    <section class="bg-white">
        <div class="text-center py-4">
            <h1 class="text-2xl font-bold uppercase text-black">
                All Satta King Chart
            </h1>

            <p class="py-2 text-sm text-gray-800">
                Select any game to check full 2026 chart record
            </p>
        </div>
    </section>

    <section class="grid grid-cols-1 gap-2 bg-white lg:grid-cols-1">
        <div
            class="text-center text-black px-4 py-2 shadow-xl bg-yellow-50 border pt-4 mx-2 my-2 rounded-xl leading-6 font-semibold h-fit text-lg">
            <h3>To Check instant SATTA KING Results, Check Below Chart 👇🏿</h3>
        </div>
    </section>

    <h3 class="py-2 text-sm font-semibold text-center text-gray-900 bg-white">
        FASTEST SATTA KING RESULT SITE ON INTERNET
    </h3>

    <div class="w-full overflow-x-auto bg-white shadow-md mt-4">
        <table
            class="w-full overflow-x-auto text-sm text-left text-gray-500 border-separate table-auto whitespace-nowrap lg:table-fixed">
            <thead>
                <tr>
                    <td
                        class="py-3 bg-[#0aa485] shadow-custom-inset-2 rounded-lg lg:rounded-xl text-center text-[12px] lg:text-base font-bold text-white">
                        GAME NAME
                    </td>

                    <td
                        class="py-3 bg-[#0aa485] shadow-custom-inset-2 rounded-lg lg:rounded-xl text-center text-[12px] lg:text-base font-bold text-white">
                        RESULT TIME
                    </td>

                    <td
                        class="py-3 bg-[#0aa485] shadow-custom-inset-2 rounded-lg lg:rounded-xl text-center text-[12px] lg:text-base font-bold text-white">
                        YEAR CHART
                    </td>
                </tr>
            </thead>

            <tbody>
                @forelse($games as $game)
                    <tr>
                        <td
                            class="text-white lg:px-6 px-1 lg:py-4 py-3 bg-[#2d4b58] shadow-custom-inset1 text-sm font-semibold whitespace-nowrap lg:text-base rounded-lg uppercase">
                            {{ $game->name }}
                        </td>

                        <td
                            class="text-white lg:px-6 px-1 lg:py-4 py-3 bg-[#2d4b58] shadow-custom-inset1 text-sm font-semibold whitespace-nowrap lg:text-base rounded-lg text-center">
                            {{ $game->result_time ?: '-' }}
                        </td>

                        <td
                            class="text-white lg:px-6 px-1 lg:py-4 py-3 bg-[#2d4b58] shadow-custom-inset1 text-sm font-semibold whitespace-nowrap lg:text-base rounded-lg">
                            <div class="flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('game.record', $game->slug) }}"
                                    class="inline-block px-3 py-1 bg-yellow-400 text-black rounded-md hover:bg-yellow-300 font-bold">
                                    2026
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center p-4 bg-white text-black">
                            No chart games found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-8 mx-auto mt-4 bg-gray-600">
        <h2 class="pb-4 text-2xl font-bold text-center text-white">
            Check All Game 2026 Chart
        </h2>

        <form method="get" action="javascript:void(0);">
            <div class="flex items-center justify-center mx-auto rounded">
                <div class="flex mx-2">
                    <select id="gameSelect"
                        class="py-2 text-sm uppercase bg-white rounded-md outline-none md:py-3 md:text-base lg:px-3">
                        @foreach ($games as $game)
                            <option value="{{ $game->slug }}">
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>

                    <select id="yearSelect"
                        class="px-2 py-2 mx-0 ml-1 text-sm bg-white rounded-md outline-none md:py-3 md:text-base lg:mx-3">
                        <option value="2026">2026</option>
                    </select>
                </div>

                <button type="button" onclick="openYearChart()" class="ShinyButton_shadow__btn__ZfTiW">
                    Check Chart
                </button>
            </div>
        </form>
    </div>

    <script>
        function openYearChart() {
            let slug = document.getElementById('gameSelect').value;

            if (!slug) {
                alert('Please select game');
                return;
            }

            window.location.href = "{{ url('/records') }}/" + slug;

            // window.location.href = "{{ url('/') }}/" + encodeURIComponent(slug);
        }
    </script>

@endsection