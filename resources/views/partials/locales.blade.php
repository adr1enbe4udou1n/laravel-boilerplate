@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" data-turbolinks="false"
       href="{{ localize_url($localeCode, isset($attributes) ? $attributes : [], isset($translatable) ? $translatable : null) }}">
        {{ $properties['native'] }}
    </a>
@endforeach
