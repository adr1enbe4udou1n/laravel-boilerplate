@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <li>
        <a rel="alternate" hreflang="{{ $localeCode }}"
           href="{{ localize_url($localeCode, isset($translatable) ? $translatable : null) }}">
            {{ $properties['native'] }}
        </a>
    </li>
@endforeach