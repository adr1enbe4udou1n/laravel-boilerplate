<div class="card-block">

    {{ Form::bsText('source', [
        'required' => true,
        'title' => trans('validation.attributes.source_path'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) }}

    {{ Form::bsToggle('active', [
        'title' => trans('validation.attributes.active'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'checked' => isset($redirection) ? $redirection->active : true
    ]) }}

    {{ Form::bsText('target', [
        'required' => true,
        'title' => trans('validation.attributes.target_path'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
    ]) }}

    {{ Form::bsChoices('type', [
        'required' => true,
        'title' => trans('validation.attributes.redirect_type'),
        'label_col_class' => 'col-lg-3',
        'field_wrapper_class' => 'col-lg-9',
        'choices' => config('redirections'),
    ]) }}
</div>