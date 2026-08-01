<?php

namespace App\Providers;

use App\View\Composers\StoriesComposer;
use App\View\Composers\SuggestionsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('components.post.stories', StoriesComposer::class);
        View::composer('components.suggestions', SuggestionsComposer::class);
    }
}
