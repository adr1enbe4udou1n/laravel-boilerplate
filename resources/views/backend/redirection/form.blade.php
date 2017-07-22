<div class="card-block">

    @component('components.fieldset', [
        'name' => 'source',
        'title' => trans('validation.attributes.source_path'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsInput('source', [
        'required' => true,
        'placeholder' => trans('validation.attributes.source_path'),
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'active',
        'title' => trans('validation.attributes.active'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsToggle('active', [
        'checked' => isset($redirection) ? $redirection->active : true
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'target',
        'title' => trans('validation.attributes.target_path'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsInput('target', [
        'required' => true,
        'placeholder' => trans('validation.attributes.target_path'),
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'type',
        'title' => trans('validation.attributes.redirect_type'),
        'horizontal' => true,
        'label_cols' => 3
    ])
    {{ Form::bsChoices('type', [
        'required' => true,
        'stacked' => true,
        'choices' => config('redirections'),
    ]) }}
    @endcomponent
</div>