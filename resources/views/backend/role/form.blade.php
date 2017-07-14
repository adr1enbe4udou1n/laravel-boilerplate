<div class="card-block">
    {{ Form::bsText('name', [
        'required' => true,
        'title' => trans('validation.attributes.name'),
        'label_col_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) }}

    {{ Form::bsText('display_name', [
        'title' => trans('validation.attributes.display_name'),
        'label_col_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10',
    ]) }}

    {{ Form::bsText('description', [
        'title' => trans('validation.attributes.description'),
        'label_col_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10'
    ]) }}

    {{ Form::bsText('order', [
        'type' => 'number',
        'title' => trans('validation.attributes.order'),
        'label_col_class' => 'col-lg-2',
        'field_wrapper_class' => 'col-lg-10'
    ]) }}

    <div class="form-group row">
        {{ Form::label('permissions', trans('validation.attributes.permissions'), ['class' =>  'col-lg-2 text-right col-form-label']) }}
        <div class="col-lg-10">
        @foreach($permissions->chunk(4) as $chunk)
            <div class="row">
            @foreach($chunk as $category => $permissions)
                <div class="col-md-3">
                    <h4>@lang($category)</h4>
                    {{ Form::bsChoices('permissions', [
                        'form_group' => false,
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