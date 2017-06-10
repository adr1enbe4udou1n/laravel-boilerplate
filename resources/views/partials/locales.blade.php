@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <li>
        <a rel="alternate" hreflang="{{ $localeCode }}"
           href="{{ LaravelLocalization::getLocalizedURL($localeCode, route_alias(request()->route()->getName(), [], $localeCode), [], true) }}">
            {{ $properties['native'] }}
        </a>
    </li>
@endforeach