{{ Form::select($name, $options, $selected ?? null, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
