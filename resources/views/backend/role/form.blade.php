<div class="card-block">
    @component('components.fieldset', [
        'name' => 'name',
        'title' => trans('validation.attributes.name'),
        'horizontal' => true,
        'label_cols' => 2
    ])
    {{ Form::bsInput('name', [
        'required' => true,
        'placeholder' => trans('validation.attributes.name'),
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'display_name',
        'title' => trans('validation.attributes.display_name'),
        'horizontal' => true,
        'label_cols' => 2
    ])
    {{ Form::bsInput('display_name', [
        'placeholder' => trans('validation.attributes.display_name'),
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'description',
        'title' => trans('validation.attributes.description'),
        'horizontal' => true,
        'label_cols' => 2
    ])
    {{ Form::bsInput('description', [
        'placeholder' => trans('validation.attributes.description'),
    ]) }}
    @endcomponent

    @component('components.fieldset', [
        'name' => 'order',
        'title' => trans('validation.attributes.order'),
        'horizontal' => true,
        'label_cols' => 2
    ])
    {{ Form::bsInput('order', [
        'type' => 'number',
        'placeholder' => trans('validation.attributes.order'),
    ]) }}
    @endcomponent

    <div class="form-group row">
        {{ Form::label('permissions', trans('validation.attributes.permissions'), ['class' =>  'col-lg-2 col-form-label']) }}
        <div class="col-lg-10">
        @foreach($permissions->chunk(4) as $chunk)
            <div class="row">
            @foreach($chunk as $category => $permissions)
                <div class="col-md-3">
                    <h4>@lang($category)</h4>
                    {{ Form::bsChoices('permissions', [
                        'multiple' => true,
                        'stacked' => true,
                        'choices' => $permissions,
                        'choice_label' => 'display_name',
                        'choice_tooltip' => [
                            'position' => 'right',
                            'title' => 'description',
                        ]
                    ]) }}
                </div>
            @endforeach
            </div>
        @endforeach
        </div>
    </div>
</div>