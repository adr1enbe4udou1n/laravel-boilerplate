{{ Form::open(['route' => [$route], 'class' => 'form-inline', 'role' => 'form', 'method' => 'POST',
    'name' => 'bulk_actions',
    'data-toggle' => 'bulk-form',
    'data-target' => "#$table_id",
    'data-trans-title' => trans('labels.are_you_sure'),
    'data-trans-button-confirm' => trans('buttons.apply'),
    'data-trans-button-cancel' => trans('buttons.cancel'),
])}}
<div class="form-group form-group-sm">
    {{ Form::select('action', $actions, null, ['class' => 'form-control']) }}
</div>
{{ Form::submit(trans('buttons.apply'), ['class' => 'btn btn-danger btn-sm']) }}
{{ Form::close() }}