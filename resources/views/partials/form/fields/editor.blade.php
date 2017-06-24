<div @isset($height)style="height: {{ $height }}px;" @endisset data-toggle="editor" data-placeholder="{{ isset($placeholder) ? $placeholder : $title }}"></div>
{{ Form::textarea($name, null, ['id' => $name, 'class' => 'hidden']) }}
