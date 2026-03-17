<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
      #Admin

      view()->composer([
        'components.forms-generator',
        'components.language-selector',
        'components.layouts.admin'
      ],
        'App\Http\ViewComposers\Language'
      );

      view()->composer([
        'components.modal-image',
      ],
        'App\Http\ViewComposers\Image'
      );
    }
}