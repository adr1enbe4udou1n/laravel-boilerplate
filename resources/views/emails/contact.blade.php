@component('mail::message')
{{-- Greeting --}}
@lang('mails.layout.hello')

{{-- New submission message received --}}
@lang('mails.contact.new_contact')

{{-- Submission data --}}
@component('mail::table')
|             |             |
| -----------:|:----------- |
@foreach ($data as $name => $value)
| @lang("validation.attributes.$name") : | {{ $value }} |
@endforeach
@endcomponent

@component('mail::panel')
## @lang('validation.attributes.message') :

{{ $message }}
@endcomponent

{{-- Salutations --}}
@lang('mails.layout.regards'), {{ config('app.name') }}

@endcomponent
