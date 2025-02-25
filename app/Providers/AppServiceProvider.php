<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Policies\UserPolicy;
use App\Policies\CustomUserPolicy;
use Studio1902\PeakSeo\Handlers\ErrorPage;
use Livewire\Livewire;
use App\Livewire\VoteButton;

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
        ErrorPage::handle404AsEntry();

        // Register Livewire Components
        Livewire::component('vote-button', VoteButton::class);
    }
}
