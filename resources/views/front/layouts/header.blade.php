<div>
    <nav class="border-gray-200 bg-gradient-to-br from-blue-400 to-pink-700">
        <div class="flex flex-wrap items-center justify-center p-4 ">
            <a href="/"><img src="{{ asset('Logo(2).png') }}" width="150px" height="150px" style="border-radius:60px" alt="Super 7 Satta King" class="lazy"/></a>
        </div>
    </nav>
    <nav class="bg-white ">
        <div class="px-4 py-3 mx-auto md:px-6">
            <div class="flex items-center justify-center">
                <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium">
                    <li><a class="text-gray-900 hover:underline" aria-current="page" href="/">Home</a>
                    <li><a class="text-gray-900 hover:underline" aria-current="page"
                            href="{{ route('chart') }}">Chart</a>
                    </li>
                    <li><a target="_blank" rel="noopener noreferrer" href="https://wa.me/+917015916793"
                            class="text-gray-900 hover:underline">Play Now</a></li>
                    {{-- <li> @auth
                        <a class="text-gray-900 hover:underline" aria-current="page" href="{{ route('admin.dashboard') }}">MY ACCOUNT</a>
                    @else
                        <a class="text-gray-900 hover:underline" aria-current="page" href="{{ route('index') }}"@class([
                            'active' => request()->routeIs('index'),
                        ])>
                            LOGIN
                        </a>
                    @endauth</li> --}}
                </ul>
            </div>
        </div>
    </nav>
</div>
