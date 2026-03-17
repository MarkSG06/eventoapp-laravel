<x-layouts.public :languages="$languages">
    <section class="hero">
        <h1>{{ __('front/hero.title') }}</h1>
        <p>{{ __('front/hero.description') }}</p>
        <button onclick="window.location.href='{{ route(app()->getLocale() . '.tickets') }}'">
            {{ __('front/hero.button') }}
        </button>
    </section>
</x-layouts.public>