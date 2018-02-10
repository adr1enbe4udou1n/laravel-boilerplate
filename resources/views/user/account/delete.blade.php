@lang('labels.user.account_delete')

<form action="{{ route('user.account.delete') }}" method="POST">
    @csrf
    @method('DELETE')

    <button class="btn btn-danger"
            data-toggle="confirm"
            data-trans-button-cancel="@lang('buttons.cancel')"
            data-trans-button-confirm="@lang('buttons.delete')"
            data-trans-title="@lang('labels.are_you_sure')">@lang('labels.user.delete')</button>
</form>
