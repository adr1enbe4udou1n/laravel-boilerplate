@if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
@elseif (isset($flashMessage))
    <div class="alert {{ isset($flashType) ? "alert-$flashType" : 'alert-info' }}">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @if(is_array(json_decode($flashMessage, true)))
            {!! implode('', $flashMessage->all(':message<br/>')) !!}
        @else
            {!! $flashMessage !!}
        @endif
    </div>
@endif