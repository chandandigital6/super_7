<div class="max-w-screen-xl px-4 mx-auto md:px-6">
    <h1 class="text-lg font-bold text-center text-gray-900 uppercase">
        Super A7 Satta King Result Today – Updated Live Instantly
    </h1>
</div>

<div class="py-2 text-lg font-bold text-center text-black bg-white">
    <div class="liveresult">
        <div class="datetime">
            <div id="clockbox"></div>
        </div>
    </div>
</div>

<div class="w-full mx-auto mb-3 bg-black px-3 py-4 overflow-hidden">

    <div class="grid grid-cols-2 gap-4 max-w-screen-md mx-auto">

        @forelse($navGames ?? collect() as $game)
            <div class="text-center">
                <p class="text-base md:text-2xl font-bold text-white uppercase mb-1">
                    {{ $game->name ?: 'NA' }}
                </p>

                @php
                    $resultNumber = $game->todayResult->result ?? null;
                @endphp

                <div class="text-3xl font-bold text-white min-h-[42px] flex items-center justify-center">
                    @if($resultNumber !== null && $resultNumber !== '')
                        @if(is_numeric($resultNumber) && (int) $resultNumber <= 9)
                            {{ str_pad($resultNumber, 2, '0', STR_PAD_LEFT) }}
                        @else
                            {{ $resultNumber }}
                        @endif
                    @else
                        <img class="lazy w-10 h-10 object-contain"
                             src="{{ asset('tamplate/admin/upimages/d.gif') }}"
                             alt="waiting">
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center">
                <p class="text-xl font-bold text-white uppercase">NA</p>
                <img class="lazy w-10 h-10 object-contain mx-auto mt-2"
                     src="{{ asset('tamplate/admin/upimages/d.gif') }}"
                     alt="waiting">
            </div>
        @endforelse

    </div>

</div>