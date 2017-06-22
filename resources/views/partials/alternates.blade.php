@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <link rel="alternate" href="{{ localize_url($localeCode, isset($attributes) ? $attributes : [], isset($translatable) ? $translatable : null) }}" hreflang="{{ $localeCode }}"/>
@endforeach