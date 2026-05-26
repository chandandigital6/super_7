<section class="bg-black py-5">
    <div class="text-center text-white" id="liveResultBox">

        @forelse($liveGames as $game)
            <div class="mb-4">
                <div class="text-lg">
                    {{ $game['name'] ?? '' }}
                </div>

                <div class="text-4xl font-bold">
                    @if(!empty($game['result']['result']))
                        {{ $game['result']['result'] }}
                    @else
                        <div class="inline-block w-6 h-6 border-4 border-white border-t-green-500 rounded-full animate-spin"></div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-white">No Games Found</div>
        @endforelse

    </div>
</section>




<script>
    async function loadLiveResults() {
        try {
            const response = await fetch("{{ $apiBaseUrl ?? url('/api/home-live-results') }}");
            const data = await response.json();

            if (!data.success) return;

            let html = '';

            if (data.games.length > 0) {
                data.games.forEach(game => {
                    html += `
                        <div class="mb-4">
                            <div class="text-lg">${game.name ?? ''}</div>
                            <div class="text-4xl font-bold">
                                ${game.result && game.result.result
                                    ? game.result.result
                                    : '<div class="inline-block w-6 h-6 border-4 border-white border-t-green-500 rounded-full animate-spin"></div>'
                                }
                            </div>
                        </div>
                    `;
                });
            } else {
                html = `<div class="text-white">No Games Found</div>`;
            }

            document.getElementById('liveResultBox').innerHTML = html;

        } catch (error) {
            console.log(error);
        }
    }

    setInterval(loadLiveResults, 10000);
</script>