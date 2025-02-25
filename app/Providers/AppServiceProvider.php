<?php

namespace App\Providers;

use App\Policies\CustomUserPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Statamic\Policies\UserPolicy;
use Studio1902\PeakSeo\Handlers\ErrorPage;
use Statamic\Facades\Collection;
use Statamic\Facades\Entry;
use Statamic\Statamic;
use App\Models\Ranking;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserPolicy::class, CustomUserPolicy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Statamic::script('app', 'cp');
        // Statamic::style('app', 'cp');

        ErrorPage::handle404AsEntry();

        $this->bootRoute();

        Collection::computed('rankings', 'nominations', function ($entry) {
            $ranking = Ranking::find($entry->id());
            if (!$ranking) return collect();

            return $ranking->nominations()
                ->with(['place', 'place.votes'])
                ->get()
                ->map(function ($nomination) {
                    $placeData = json_decode($nomination->place->data, true);
                    $voteTotal = $nomination->place->votes()
                        ->where('ranking_id', $nomination->ranking_id)
                        ->sum('value');

                    return [
                        'place' => $nomination->place,
                        'place_data' => $placeData,
                        'vote_total' => $voteTotal
                    ];
                })
                ->sortByDesc('vote_total')
                ->values();
        });
    }

    public function bootRoute(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
