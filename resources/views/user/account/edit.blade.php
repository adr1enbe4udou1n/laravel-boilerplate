<form action="{{ route('user.account.update') }}" class="form-horizontal">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PATCH">

    @component('components.fieldset', [
        'name' => 'name',
        'title' => trans('validation.attributes.name'),
        'horizontal' => true,
        'label_cols' => 4
    ])
        <input name="name" placeholder="@lang('validation.attributes.name')" class="form-control" v-validate="'required'" value="{{ old('name', $logged_in_user->name) }}">
    @endcomponent

    @component('components.fieldset', [
        'name' => 'email',
        'title' => trans('validation.attributes.email'),
        'horizontal' => true,
        'label_cols' => 4
    ])
        <input type="email" name="email" placeholder="@lang('validation.attributes.email')" class="form-control" v-validate="'required|email'" value="{{ old('email', $logged_in_user->email) }}">
    @endcomponent

    @component('components.fieldset', [
        'name' => 'locale',
        'title' => trans('validation.attributes.locale'),
        'horizontal' => true,
        'label_cols' => 4
    ])
        <select name="locale" class="form-control" v-validate="'required'">
            <option>@lang('labels.frontend.placeholders.locale')</option>
            @foreach($locales as $value => $text)
                <option value="{{ $value }}" {{ old('locale', $logged_in_user->locale) === $value ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
    @endcomponent

    @component('components.fieldset', [
        'name' => 'timezone',
        'title' => trans('validation.attributes.timezone'),
        'horizontal' => true,
        'label_cols' => 4
    ])
        <select name="timezone" class="form-control" v-validate="'required'">
            <option>@lang('labels.frontend.placeholders.timezone')</option>
            @foreach($timezones as $text)
                <option value="{{ $text }}" {{ old('timezone', $logged_in_user->timezone) === $text ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
    @endcomponent

    <div class="form-group row">
        <div class="col-md-8 ml-auto">
            <button class="btn btn-primary">@lang('buttons.update')</button>
        </div>
    </div>

</form>