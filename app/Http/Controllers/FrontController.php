<?php

namespace App\Http\Controllers;

use App\Models\SeoPage;
use App\Models\Advertisement;
use App\Models\ContentBlock;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;



class FrontController extends Controller
{


  private string $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = rtrim((string) config('services.main_api.url'), '/');
    }

    private function cacheTtlForDate(string $date)
    {
        $today = Carbon::today('Asia/Kolkata')->format('Y-m-d');

        // Aaj ka result frequently update ho sakta hai, isliye short cache
        if ($date === $today) {
            return now()->addSeconds(45);
        }

        // Purane dates ke result almost fixed hote hain
        return now()->addHours(12);
    }

    private function forgetBadCache(string $cacheKey): void
    {
        $cached = Cache::get($cacheKey);

        if ($cached instanceof \__PHP_Incomplete_Class) {
            Cache::forget($cacheKey);
            return;
        }

        if ($cached instanceof Collection) {
            Cache::forget($cacheKey);
            return;
        }

        if (is_object($cached) && ! is_array($cached)) {
            Cache::forget($cacheKey);
        }
    }

    private function getGamesResultByDate(string $date): Collection
    {
        $cacheKey = "front_games_results_{$date}";

        $this->forgetBadCache($cacheKey);

        $cached = Cache::get($cacheKey);

        if (is_array($cached)) {
            return collect($cached);
        }

        try {
            $response = Http::timeout(8)
                ->connectTimeout(3)
                ->retry(1, 200)
                ->acceptJson()
                ->get($this->apiBaseUrl . '/api/games-results', [
                    'date' => $date,
                ]);

            $games = $response->successful()
                ? $response->json('games', [])
                : [];

            if (! is_array($games)) {
                $games = [];
            }

            // Cache me sirf array store karo, Collection ya Model nahi
            Cache::put($cacheKey, $games, $this->cacheTtlForDate($date));

            return collect($games);
        } catch (\Throwable $e) {
            return collect();
        }
    }

    private function getSeoHome()
    {
        $cacheKey = 'front_seo_home_array';

        $this->forgetBadCache($cacheKey);

        $cached = Cache::get($cacheKey);

        if (is_array($cached)) {
            return (object) $cached;
        }

        $seo = SeoPage::where('page_key', 'home')->first();

        if (! $seo) {
            Cache::put($cacheKey, null, now()->addMinutes(10));
            return null;
        }

        $seoArray = [
            'id' => $seo->id,
            'page_key' => $seo->page_key,
            'meta_title' => $seo->meta_title,
            'meta_description' => $seo->meta_description,
            'meta_keywords' => $seo->meta_keywords,
            'canonical_url' => $seo->canonical_url,
            'og_title' => $seo->og_title,
            'og_description' => $seo->og_description,
            'og_image' => $seo->og_image,
            'schema_markup' => $seo->schema_markup,
        ];

        Cache::put($cacheKey, $seoArray, now()->addMinutes(10));

        return (object) $seoArray;
    }

    private function getActiveAdvertisements(): Collection
    {
        $cacheKey = 'front_active_advertisements_array';

        $this->forgetBadCache($cacheKey);

        $cached = Cache::get($cacheKey);

        if (is_array($cached)) {
            return collect($cached)->map(function ($ad) {
                return (object) $ad;
            });
        }

        $advertisements = Advertisement::where('is_active', true)
            ->select([
                'id',
                'title',
                'position',
                'content',
                'image',
                'link',
                'is_active',
                'created_at',
                'updated_at',
            ])
            ->get()
            ->map(function ($ad) {
                return [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'position' => $ad->position,
                    'content' => $ad->content,
                    'image' => $ad->image,
                    'link' => $ad->link,
                    'is_active' => $ad->is_active,
                    'created_at' => optional($ad->created_at)->toDateTimeString(),
                    'updated_at' => optional($ad->updated_at)->toDateTimeString(),
                ];
            })
            ->values()
            ->toArray();

        // Cache me Eloquent model nahi, sirf plain array
        Cache::put($cacheKey, $advertisements, now()->addMinutes(2));

        return collect($advertisements)->map(function ($ad) {
            return (object) $ad;
        });
    }

    public function home()
    {
        $today = Carbon::today('Asia/Kolkata');
        $yesterday = Carbon::yesterday('Asia/Kolkata');

        $todayDate = $today->format('Y-m-d');
        $yesterdayDate = $yesterday->format('Y-m-d');

        $todayGames = $this->getGamesResultByDate($todayDate);
        $yesterdayGames = $this->getGamesResultByDate($yesterdayDate)->keyBy('slug');

        $games = $todayGames->map(function ($game) use ($yesterdayGames) {
            $slug = $game['slug'] ?? '';

            $yesterdayGame = $yesterdayGames->get($slug);

            $todayResult = $game['result'] ?? [];
            $yesterdayResult = is_array($yesterdayGame)
                ? ($yesterdayGame['result'] ?? [])
                : [];

            return (object) [
                'id'          => $game['id'] ?? null,
                'name'        => $game['name'] ?? '',
                'slug'        => $slug,
                'result_time' => $game['result_time'] ?? '',
                'sort_order'  => $game['sort_order'] ?? 0,

                'todayResult' => (object) [
                    'id'           => $todayResult['id'] ?? null,
                    'result_date'  => $todayResult['result_date'] ?? null,
                    'result'       => $todayResult['result'] ?? null,
                    'status'       => $todayResult['status'] ?? 'waiting',
                    'show_minutes' => $todayResult['show_minutes'] ?? 10,
                    'updated_at'   => $todayResult['updated_at'] ?? null,
                    'is_live'      => $todayResult['is_live'] ?? false,
                ],

                'yesterdayResult' => (object) [
                    'id'           => $yesterdayResult['id'] ?? null,
                    'result_date'  => $yesterdayResult['result_date'] ?? null,
                    'result'       => $yesterdayResult['result'] ?? null,
                    'status'       => $yesterdayResult['status'] ?? 'waiting',
                ],

                'latestResult' => (object) [
                    'result' => $todayResult['result'] ?? null,
                    'status' => $todayResult['status'] ?? 'waiting',
                ],
            ];
        })->values();

        // Chart ke liye original sort order same rakha hai
        $chartGames = $games->sortBy('sort_order')->values();

        $startDate = $today->copy()->startOfMonth();
        $endDate = $today->copy()->endOfMonth();
        $dates = CarbonPeriod::create($startDate, $endDate);

        $monthlyResults = collect();

        foreach ($dates as $date) {
            $dateKey = $date->format('Y-m-d');

            $dayGames = $this->getGamesResultByDate($dateKey);

            $monthlyResults->put(
                $dateKey,
                $dayGames->map(function ($game) {
                    $result = $game['result'] ?? [];

                    return (object) [
                        'game_id'     => $game['id'] ?? null,
                        'game_slug'   => $game['slug'] ?? '',
                        'result_date' => $result['result_date'] ?? null,
                        'result'      => $result['result'] ?? null,
                        'status'      => $result['status'] ?? 'waiting',
                    ];
                })->values()
            );
        }

        $seo = $this->getSeoHome();
        $advertisements = $this->getActiveAdvertisements();

        return view('front.home.index', compact(
            'games',
            'chartGames',
            'dates',
            'monthlyResults',
            'seo',
            'advertisements',
        ));
    }








    // private string $apiBaseUrl;

    // public function __construct()
    // {
    //     $this->apiBaseUrl = rtrim(config('services.main_api.url'), '/');
    // }





    // public function home()
    // {
    //     $today = Carbon::today('Asia/Kolkata');
    //     $yesterday = Carbon::yesterday('Asia/Kolkata');

    //     $todayResponse = Http::timeout(10)->get($this->apiBaseUrl . '/api/games-results', [
    //         'date' => $today->format('Y-m-d'),
    //     ]);

    //     $yesterdayResponse = Http::timeout(10)->get($this->apiBaseUrl . '/api/games-results', [
    //         'date' => $yesterday->format('Y-m-d'),
    //     ]);

    //     $todayGames = $todayResponse->successful()
    //         ? collect($todayResponse->json('games', []))
    //         : collect();

    //     $yesterdayGames = $yesterdayResponse->successful()
    //         ? collect($yesterdayResponse->json('games', []))->keyBy('slug')
    //         : collect();

    //     $games = $todayGames->map(function ($game) use ($yesterdayGames) {
    //         $yesterdayGame = $yesterdayGames->get($game['slug']);

    //         $todayResult = $game['result'] ?? [];
    //         $yesterdayResult = $yesterdayGame['result'] ?? [];

    //         return (object) [
    //             'id'          => $game['id'] ?? null,
    //             'name'        => $game['name'] ?? '',
    //             'slug'        => $game['slug'] ?? '',
    //             'result_time' => $game['result_time'] ?? '',
    //             'sort_order'  => $game['sort_order'] ?? 0,

    //             'todayResult' => (object) [
    //                 'id'           => $todayResult['id'] ?? null,
    //                 'result_date'  => $todayResult['result_date'] ?? null,
    //                 'result'       => $todayResult['result'] ?? null,
    //                 'status'       => $todayResult['status'] ?? 'waiting',
    //                 'show_minutes' => $todayResult['show_minutes'] ?? 10,
    //                 'updated_at'   => $todayResult['updated_at'] ?? null,
    //                 'is_live'      => $todayResult['is_live'] ?? false,
    //             ],

    //             'yesterdayResult' => (object) [
    //                 'id'           => $yesterdayResult['id'] ?? null,
    //                 'result_date'  => $yesterdayResult['result_date'] ?? null,
    //                 'result'       => $yesterdayResult['result'] ?? null,
    //                 'status'       => $yesterdayResult['status'] ?? 'waiting',
    //             ],

    //             'latestResult' => (object) [
    //                 'result' => $todayResult['result'] ?? null,
    //                 'status' => $todayResult['status'] ?? 'waiting',
    //             ],
    //         ];
    //     })->values();

    //     // Chart ke liye original game order chahiye, live/top sorting nahi
    //     $chartGames = $games->sortBy('sort_order')->values();

    //     $startDate = $today->copy()->startOfMonth();
    //     $endDate = $today->copy()->endOfMonth();
    //     $dates = CarbonPeriod::create($startDate, $endDate);

    //     $monthlyResults = collect();

    //     foreach ($dates as $date) {
    //         $response = Http::timeout(10)->get($this->apiBaseUrl . '/api/games-results', [
    //             'date' => $date->format('Y-m-d'),
    //         ]);

    //         if ($response->successful()) {
    //             $monthlyResults->put(
    //                 $date->format('Y-m-d'),
    //                 collect($response->json('games', []))->map(function ($game) {
    //                     $result = $game['result'] ?? [];

    //                     return (object) [
    //                         'game_id'     => $game['id'] ?? null,
    //                         'game_slug'   => $game['slug'] ?? '',
    //                         'result_date' => $result['result_date'] ?? null,
    //                         'result'      => $result['result'] ?? null,
    //                         'status'      => $result['status'] ?? 'waiting',
    //                     ];
    //                 })->values()
    //             );
    //         }
    //     }

    //     $seo = SeoPage::where('page_key', 'home')->first();
    //     $advertisements = Advertisement::where('is_active', true)->get();

    //     return view('front.home.index', compact(
    //         'games',
    //         'chartGames',
    //         'dates',
    //         'monthlyResults',
    //         'seo',
    //         'advertisements',
    //     ));
    // }




    public function chart()
{
    try {
        $response = Http::timeout(10)->get($this->apiBaseUrl . '/api/chart-games');

        $games = $response->successful()
            ? collect($response->json('games', []))->map(function ($game) {
                $chartYears = collect($game['chartYears'] ?? [])
                    ->map(function ($year) {
                        return (object) [
                            'year' => $year['year'] ?? null,
                        ];
                    })
                    ->filter(fn ($year) => !empty($year->year))
                    ->sortByDesc('year')
                    ->values();

                if ($chartYears->isEmpty()) {
                    $chartYears = collect([
                        (object) ['year' => now('Asia/Kolkata')->year],
                        (object) ['year' => now('Asia/Kolkata')->copy()->subYear()->year],
                        (object) ['year' => now('Asia/Kolkata')->copy()->subYears(2)->year],
                    ]);
                }

                return (object) [
                    'id'          => $game['id'] ?? null,
                    'name'        => $game['name'] ?? '',
                    'slug'        => $game['slug'] ?? '',
                    'result_time' => $game['result_time'] ?? '',
                    'sort_order'  => $game['sort_order'] ?? 0,
                    'chartYears'  => $chartYears,
                ];
            })
            ->filter(fn ($game) => !empty($game->slug))
            ->sortBy('sort_order')
            ->values()
            : collect();

    } catch (\Throwable $e) {
        \Log::error('Chart API Error', [
            'url'   => $this->apiBaseUrl . '/api/chart-games',
            'error' => $e->getMessage(),
        ]);

        $games = collect();
    }

    $seo = SeoPage::where('page_key', 'chart')->first();

    return view('front.chart.index', compact('games', 'seo'));
}



public function gameRecord(string $slug)
{
    return $this->yearRecord($slug, now('Asia/Kolkata')->year, true);
}

public function yearRecord(string $slug, int $year, bool $mainRecordPage = false)
{
    try {
        $response = Http::timeout(10)->get(
            $this->apiBaseUrl . "/api/game-year-record/{$slug}/{$year}"
        );

        if ($response->successful()) {
            $apiData = $response->json();

            $gameData = $apiData['game'] ?? [];

            $game = (object) [
                'id'          => $gameData['id'] ?? null,
                'name'        => $gameData['name'] ?? ucwords(str_replace('-', ' ', $slug)),
                'slug'        => $gameData['slug'] ?? $slug,
                'result_time' => $gameData['result_time'] ?? null,
            ];

            $results = collect($apiData['results'] ?? [])
                ->map(function ($result) {
                    return (object) [
                        'result_date' => $result['result_date'] ?? null,
                        'result'      => $result['result'] ?? null,
                        'status'      => $result['status'] ?? 'waiting',
                    ];
                })
                ->filter(fn ($result) => !empty($result->result_date))
                ->values();

        } else {
            $game = (object) [
                'id'          => null,
                'name'        => ucwords(str_replace('-', ' ', $slug)),
                'slug'        => $slug,
                'result_time' => null,
            ];

            $results = collect();
        }

    } catch (\Throwable $e) {
        \Log::error('Game Year Record API Error', [
            'url'   => $this->apiBaseUrl . "/api/game-year-record/{$slug}/{$year}",
            'error' => $e->getMessage(),
        ]);

        $game = (object) [
            'id'          => null,
            'name'        => ucwords(str_replace('-', ' ', $slug)),
            'slug'        => $slug,
            'result_time' => null,
        ];

        $results = collect();
    }

    /*
    |--------------------------------------------------------------------------
    | SEO Data - Strict Logic
    |--------------------------------------------------------------------------
    | /records/disawar      => game_slug + year NULL
    | /records/disawar/2025 => game_slug + year 2025
    |--------------------------------------------------------------------------
    */
    if ($mainRecordPage) {
        // Main game page SEO only
        $seo = SeoPage::where('game_slug', $slug)
            ->whereNull('year')
            ->first();

        if (!$seo) {
            $seo = SeoPage::where('page_key', 'game-record')->first();
        }
    } else {
        // Year page SEO only
        $seo = SeoPage::where('game_slug', $slug)
            ->where('year', $year)
            ->first();

        if (!$seo) {
            $seo = SeoPage::where('page_key', 'game-year-record')->first();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Canonical URL
    |--------------------------------------------------------------------------
    */
    $canonicalUrl = $mainRecordPage
        ? route('game.record', $slug)
        : route('game.yearRecord', [$slug, $year]);

    if ($seo) {
        $seo = clone $seo;
        $seo->canonical_url = $canonicalUrl;

        /*
        |--------------------------------------------------------------------------
        | Dynamic SEO Replace
        |--------------------------------------------------------------------------
        | SEO title/description me {game}, {slug}, {year} use kar sakte ho.
        |--------------------------------------------------------------------------
        */
        $replace = [
            '{game}' => $game->name,
            '{slug}' => $slug,
            '{year}' => $year,
        ];

        $seo->meta_title = $seo->meta_title
            ? str_replace(array_keys($replace), array_values($replace), $seo->meta_title)
            : null;

        $seo->meta_description = $seo->meta_description
            ? str_replace(array_keys($replace), array_values($replace), $seo->meta_description)
            : null;

        $seo->meta_keywords = $seo->meta_keywords
            ? str_replace(array_keys($replace), array_values($replace), $seo->meta_keywords)
            : null;

        $seo->og_title = $seo->og_title
            ? str_replace(array_keys($replace), array_values($replace), $seo->og_title)
            : null;

        $seo->og_description = $seo->og_description
            ? str_replace(array_keys($replace), array_values($replace), $seo->og_description)
            : null;

    } else {
        $seo = (object) [
            'meta_title'       => $mainRecordPage
                ? "{$game->name} Record Chart"
                : "{$game->name} {$year} Record Chart",

            'meta_description' => $mainRecordPage
                ? "{$game->name} record chart, old result and complete satta chart."
                : "{$game->name} {$year} record chart, old result and complete satta chart.",

            'meta_keywords'    => $mainRecordPage
                ? "{$game->name} record, {$game->name} chart"
                : "{$game->name} {$year} record, {$game->name} {$year} chart",

            'canonical_url'    => $canonicalUrl,
            'og_title'         => null,
            'og_description'   => null,
            'og_image'         => null,
            'schema_markup'    => null,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Content Blocks - Strict Logic
    |--------------------------------------------------------------------------
    | /records/disawar      => game_slug + year NULL content
    | /records/disawar/2025 => game_slug + year 2025 content
    |--------------------------------------------------------------------------
    */
    if ($mainRecordPage) {
        // Main game page content only
        $contentBlocks = ContentBlock::where('game_slug', $slug)
            ->whereNull('year')
            ->where('is_active', true)
            ->latest()
            ->get();
    } else {
        // Year page content only
        $contentBlocks = ContentBlock::where('game_slug', $slug)
            ->where('year', $year)
            ->where('is_active', true)
            ->latest()
            ->get();
    }

    return view('front.game.year_record', compact(
        'game',
        'results',
        'year',
        'seo',
        'contentBlocks'
    ));
}


public function yearRecordold(string $slug, int $year, bool $mainRecordPage = false)
{
    try {
        $response = Http::timeout(10)->get(
            $this->apiBaseUrl . "/api/game-year-record/{$slug}/{$year}"
        );

        if ($response->successful()) {
            $apiData = $response->json();

            $gameData = $apiData['game'] ?? [];

            $game = (object) [
                'id'          => $gameData['id'] ?? null,
                'name'        => $gameData['name'] ?? ucwords(str_replace('-', ' ', $slug)),
                'slug'        => $gameData['slug'] ?? $slug,
                'result_time' => $gameData['result_time'] ?? null,
            ];

            $results = collect($apiData['results'] ?? [])
                ->map(function ($result) {
                    return (object) [
                        'result_date' => $result['result_date'] ?? null,
                        'result'      => $result['result'] ?? null,
                        'status'      => $result['status'] ?? 'waiting',
                    ];
                })
                ->filter(fn ($result) => !empty($result->result_date))
                ->values();

        } else {
            $game = (object) [
                'id'          => null,
                'name'        => ucwords(str_replace('-', ' ', $slug)),
                'slug'        => $slug,
                'result_time' => null,
            ];

            $results = collect();
        }

    } catch (\Throwable $e) {
        \Log::error('Game Year Record API Error', [
            'url'   => $this->apiBaseUrl . "/api/game-year-record/{$slug}/{$year}",
            'error' => $e->getMessage(),
        ]);

        $game = (object) [
            'id'          => null,
            'name'        => ucwords(str_replace('-', ' ', $slug)),
            'slug'        => $slug,
            'result_time' => null,
        ];

        $results = collect();
    }

    /*
    |--------------------------------------------------------------------------
    | SEO Data
    |--------------------------------------------------------------------------
    */
    $seo = SeoPage::where('game_slug', $slug)
        ->where('year', $year)
        ->first();

    if (!$seo) {
        $seo = SeoPage::where('game_slug', $slug)
            ->whereNull('year')
            ->first();
    }

    if (!$seo) {
        $seo = SeoPage::where('page_key', 'game-year-record')->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Canonical URL Fix
    |--------------------------------------------------------------------------
    | /records/disawar       => canonical /records/disawar
    | /records/disawar/2026  => canonical /records/disawar/2026
    | /records/disawar/2025  => canonical /records/disawar/2025
    */
    $canonicalUrl = $mainRecordPage
        ? route('game.record', $slug)
        : route('game.yearRecord', [$slug, $year]);

    if ($seo) {
        $seo = clone $seo;
        $seo->canonical_url = $canonicalUrl;
    } else {
        $seo = (object) [
            'meta_title'       => null,
            'meta_description' => null,
            'meta_keywords'    => null,
            'canonical_url'    => $canonicalUrl,
            'og_title'         => null,
            'og_description'   => null,
            'og_image'         => null,
            'schema_markup'    => null,
        ];
    }

    $contentBlocks = ContentBlock::where('game_slug', $slug)
        ->where('is_active', true)
        ->latest()
        ->get();

    return view('front.game.year_record', compact(
        'game',
        'results',
        'year',
        'seo',
        'contentBlocks'
    ));
}




 

    public function products()
    {
        return view('front.products.index');
    }

    public function singleProduct()
    {
        return view('front.products.single');
    }

    public function services()
    {
        return view('front.services.index');
    }

    public function aboutUs()
    {
        return view('front.about-us.index');
    }

    public function contactUs()
    {
        $seo = SeoPage::where('page_key', 'contact-us')->first();
        return view('front.contact-us.index', compact('seo'));
    }

    public function privacyPolicy()
    {
        $seo = SeoPage::where('page_key', 'privacy-policy')->first();
        return view('front.privacy-policy.index', compact('seo'));
    }

    public function termsConditions()
    {
        $seo = SeoPage::where('page_key', 'terms-conditions')->first();
        return view('front.terms-conditions.index', compact('seo'));
    }
}
