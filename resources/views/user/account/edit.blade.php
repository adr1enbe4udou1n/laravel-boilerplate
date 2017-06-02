{{ Form::model($logged_in_user, ['route' => 'user.account.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

{!! form_row('input', [
    'type' => 'text',
    'name' => 'name',
    'title' => trans('validation.attributes.name'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) !!}

{!! form_row('input', [
    'type' => 'email',
    'name' => 'email',
    'title' => trans('validation.attributes.email'),
    'label_class' => 'col-md-4',
    'field_wrapper_class' => 'col-md-6',
]) !!}

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{ Form::submit(trans('buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
    </div>
</div>

{{ Form::close() }}