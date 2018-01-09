@component('components.form-group', [
    'name' => $name,
    'title' => $title,
    'label_cols' => $label_cols,
    'description' => $description
])
    {{ Form::input($type, $name, $value, array_merge(['id' => $name, 'class' => $errors->has($name) ? 'form-control is-invalid' : 'form-control'], $attributes)) }}
@endcomponent
