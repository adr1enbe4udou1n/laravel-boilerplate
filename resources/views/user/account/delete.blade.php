@lang('labels.user.account_delete')

{{ Form::open(['route' => ['user.account.delete'], 'method' => 'DELETE']) }}

{{ Form::submit(trans('labels.user.delete'), [
    'class' => 'btn btn-danger',
    'data-toggle' => 'confirm',
    'data-trans-button-cancel' => trans('buttons.cancel'),
    'data-trans-button-confirm' => trans('buttons.delete'),
    'data-trans-title' => trans('labels.are_you_sure'),
]) }}

{{ Form::close() }}