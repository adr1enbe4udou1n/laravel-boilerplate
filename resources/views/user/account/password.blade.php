<form action="{{ route('user.password.change') }}" class="form-horizontal">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PATCH">

    @component('components.fieldset', [
        'name' => 'old_password',
        'title' => trans('validation.attributes.old_password'),
        'horizontal' => true,
        'label_cols' => 4
    ])
        <input type="password" name="old_password" placeholder="@lang('validation.attributes.old_password')" class="form-control" v-validate="'required'">
    @endcomponent

    @component('components.fieldset', [
        'name' => 'password',
        'title' => trans('validation.attributes.new_password'),
        'horizontal' => true,
        'label_cols' => 4
    ])
        <input type="password" name="new_password" placeholder="@lang('validation.attributes.new_password')" class="form-control" v-validate="'required'" data-toggle="password-strength-meter">
    @endcomponent

    @component('components.fieldset', [
        'name' => 'password_confirmation',
        'title' => trans('validation.attributes.new_password_confirmation'),
        'horizontal' => true,
        'label_cols' => 4
    ])
        <input type="password" name="password_confirmation" placeholder="@lang('validation.attributes.new_password_confirmation')" class="form-control" v-validate="'required'">
    @endcomponent

    <div class="form-group row">
        <div class="col-md-8 ml-auto">
            <button class="btn btn-primary">@lang('buttons.update')</button>
        </div>
    </div>

</form>