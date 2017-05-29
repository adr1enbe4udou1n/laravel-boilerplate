@if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
@elseif (isset($flash_message))
    <div class="alert {{ isset($flash_type) ? "alert-$flash_type" : 'alert-info' }}">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @if(is_array(json_decode($flash_message, true)))
            {!! implode('', $flash_message->all(':message<br/>')) !!}
        @else
            {!! $flash_message !!}
        @endif
    </div>
@endif