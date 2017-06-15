@if (auth()->check() && !auth()->user()->confirmed)
    <div class="alert alert-warning alert-top">
        @lang('labels.alerts.not_confirmed', ['route' => route('user.confirmation.send') ])
    </div>
@endif