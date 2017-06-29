@component('mail::message')
{{-- Greeting --}}
@lang('mails.layout.hello')

{{-- New exception --}}
@lang('mails.alert.message', ['message' => $message])

@component('mail::panel')

## @lang('mails.alert.trace')

{{-- Trace --}}
```
{{ $trace }}
```

@endcomponent

{{-- Salutations --}}
@lang('mails.layout.regards'), {{ config('app.name') }}

@endcomponent
