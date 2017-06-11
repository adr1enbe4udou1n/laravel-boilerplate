@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <li>
        <a rel="alternate" hreflang="{{ $localeCode }}"
           href="{{ LaravelLocalization::getLocalizedURL($localeCode, localized_current_url($localeCode), [], true) }}">
            {{ $properties['native'] }}
        </a>
    </li>
@endforeach